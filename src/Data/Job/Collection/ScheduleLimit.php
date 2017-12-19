<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Collection;
use NHDS\Jobs\Data\Job\Type;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Db\Model\AbstractCollection;
use Zend\Db\Sql\Expression;

class ScheduleLimit extends Collection implements ScheduleLimitInterface
{
    use Type\AwareTrait;
    const ALIAS_NUMBER_OF_SCHEDULED_JOBS = 'number_of_scheduled_jobs';

    public function getNumberOfCurrentlyScheduledJobs(): int
    {
        return (int)$this->_getRecords()[self::ALIAS_NUMBER_OF_SCHEDULED_JOBS];
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $select = $this->getSelect();
            $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($select);
            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $statement->execute()->getResource();
            $pdoStatement->setFetchMode($this->_getFetchMode());
            $records = $pdoStatement->fetchAll()[0];
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            }else {
                $this->_create(self::PROP_RECORDS, $records);
            }
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): AbstractCollection
    {
        $this->getSelect()->columns(
            [
                self::ALIAS_NUMBER_OF_SCHEDULED_JOBS => new Expression('COUNT(' . Job::FIELD_NAME_ID . ')'),
            ]
        );
        $this->getSelect()->where->equalTo(Job::FIELD_NAME_TYPE_CODE, $this->_getJobType()->getCode());
        $this->getSelect()->where
            ->nest()
            ->equalTo(Job::FIELD_NAME_ASSIGNED_STATE, Job\State\Service::STATE_WORKING)
            ->or
            ->equalTo(Job::FIELD_NAME_NEXT_STATE_REQUEST, Job\State\Service::STATE_WORKING);

        return $this;
    }
}