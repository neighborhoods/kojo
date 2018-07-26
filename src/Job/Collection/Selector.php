<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection;

use Neighborhoods\Kojo\Job\CollectionAbstract;
use Neighborhoods\Kojo\JobInterface;
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
        $records = $this->getQueryBuilder()->execute()->fetchAll();
        if ($records === false) {
            $this->_update(self::PROP_RECORDS, []);
        } else {
            $this->_update(self::PROP_RECORDS, $records);
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $select = $this->getQueryBuilder();
        $select->select(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
            ]
        );
        $select->orderBy(JobInterface::FIELD_NAME_PRIORITY, ' DESC');
        $select->where(
            $this->getQueryBuilder()->expr()->andX(
                $this->getQueryBuilder()->expr()->eq(
                    JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                    $this->getQueryBuilder()->createNamedParameter(State\ServiceInterface::STATE_WORKING)
                ),
                $this->getQueryBuilder()->expr()->in(
                    JobInterface::FIELD_NAME_ASSIGNED_STATE,
                    [
                        $this->getQueryBuilder()->createNamedParameter(State\ServiceInterface::STATE_WAITING),
                        $this->getQueryBuilder()->createNamedParameter(State\Service::STATE_CRASHED),
                        $this->getQueryBuilder()->createNamedParameter(State\Service::STATE_NEW),
                    ]),
                $this->getQueryBuilder()->expr()->lte(
                    JobInterface::FIELD_NAME_WORK_AT_DATE_TIME,
                    $this->getQueryBuilder()->createNamedParameter(gmdate("Y-m-d H:i:s"))
                )
            )
        );

        return $this;
    }
}