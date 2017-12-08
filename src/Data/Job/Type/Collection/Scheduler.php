<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\Type\Collection;
use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Jobs\Db\Connection\ContainerInterface;

class Scheduler extends Collection implements SchedulerInterface
{
    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $select = $this->getSelect();
            $select->where(TypeInterface::FIELD_NAME_CRON_EXPRESSION . ' IS NOT NULL');
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
}