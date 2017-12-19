<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\Collection;
use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Data\Job\State;

class CrashDetection extends Collection implements CrashDetectionInterface
{
    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $select = $this->getSelect();
            $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($select);
            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $statement->execute()->getResource();
            $pdoStatement->setFetchMode($this->_getFetchMode());
            $records = $pdoStatement->fetchAll();
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            }else {
                $this->_create(self::PROP_RECORDS, $records);
            }
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Collection
    {
        $select = $this->getSelect();
        $select->where(
            [
                JobInterface::FIELD_NAME_ASSIGNED_STATE => State\ServiceInterface::STATE_WORKING,
            ]
        );
        $select->columns(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
            ]
        );
        $select->order(JobInterface::FIELD_NAME_PRIORITY . ' DESC');
        $select->where(JobInterface::FIELD_NAME_WORK_AT_DATETIME . ' <= utc_timestamp()');

        return $this;
    }
}