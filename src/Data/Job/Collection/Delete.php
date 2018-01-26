<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\CollectionAbstract;
use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Db;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use Zend\Db\Sql\Expression;

class Delete extends CollectionAbstract implements DeleteInterface
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
        $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($select);
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
        $select->columns(
            [
                JobInterface::FIELD_NAME_ID,
            ]
        );
        $select->where->lessThanOrEqualTo(
            JobInterface::FIELD_NAME_DELETE_AFTER_DATE_TIME,
            new Expression('utc_timestamp()')
        );

        return $this;
    }
}