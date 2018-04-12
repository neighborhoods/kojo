<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\Job\CollectionAbstract;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Db;

class Selector extends CollectionAbstract implements SelectorInterface
{
    protected function &_getModelsArray(): array
    {
        $models = [];
        $records = &$this->getRecords();
        foreach ($records as $record) {
            $model = $this->_getModelClone();
            $model->createPersistentProperties($record);
            $models[] = $model;
        }

        return $models;
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $this->_create(self::PROP_RECORDS, []);
        }
        $select = $this->getSelect();
        $statement = $this->_getDbConnectionContainerRepository()
                          ->get(ContainerInterface::ID_JOB)
                          ->getStatement($select);
        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $statement->execute()->getResource();
        $pdoStatement->setFetchMode($this->_getFetchMode());
        $records = $pdoStatement->fetchAll();
        $this->_logSelect();
        if ($records === false) {
            $this->_update(self::PROP_RECORDS, []);
        }else {
            $this->_update(self::PROP_RECORDS, $records);
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $select = $this->getSelect();
        $select->where(
            [
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST => State\ServiceInterface::STATE_WORKING,
                JobInterface::FIELD_NAME_ASSIGNED_STATE     => [
                    State\ServiceInterface::STATE_WAITING,
                    State\Service::STATE_CRASHED,
                    State\Service::STATE_NEW,
                ],
            ]
        );
        $select->columns(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                JobInterface::FIELD_NAME_PROCESS_TYPE_CODE,
            ]
        );
        $select->order(
            [
                JobInterface::FIELD_NAME_PROCESS_TYPE_CODE . ' DESC',
                JobInterface::FIELD_NAME_PRIORITY . ' DESC',
            ]
        );
        $select->where(JobInterface::FIELD_NAME_WORK_AT_DATE_TIME . ' <= utc_timestamp()');

        return $this;
    }
}