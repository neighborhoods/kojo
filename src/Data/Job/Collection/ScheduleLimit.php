<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Data\Job\CollectionAbstract;
use Neighborhoods\Kojo\Data\Job\Type;
use Neighborhoods\Kojo\Db;

class ScheduleLimit extends CollectionAbstract implements ScheduleLimitInterface
{
    use Type\AwareTrait;
    const ALIAS_NUMBER_OF_SCHEDULED_JOBS = 'number_of_scheduled_jobs';

    public function getNumberOfCurrentlyScheduledJobs(): int
    {
        return $this->_getRecords()[self::ALIAS_NUMBER_OF_SCHEDULED_JOBS];
    }

    public function incrementNumberOfCurrentlyScheduledJobs(): ScheduleLimitInterface
    {
        ++$this->_getRecords()[self::ALIAS_NUMBER_OF_SCHEDULED_JOBS];

        return $this;
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $records = $this->getQueryBuilder()->execute()->fetchAll()[0];
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            } else {
                $this->_create(self::PROP_RECORDS, $records);
            }
            $numberOfScheduledJobs = (int)$this->_read(self::PROP_RECORDS)[self::ALIAS_NUMBER_OF_SCHEDULED_JOBS];
            $this->_read(self::PROP_RECORDS)[self::ALIAS_NUMBER_OF_SCHEDULED_JOBS] = $numberOfScheduledJobs;
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $this->getQueryBuilder()->select(
            'COUNT(' . JobInterface::FIELD_NAME_ID . ') AS ' . self::ALIAS_NUMBER_OF_SCHEDULED_JOBS
        );
        $this->getQueryBuilder()->where(
            $this->getQueryBuilder()->expr()->andX(
                $this->getQueryBuilder()->expr()->eq(
                    JobInterface::FIELD_NAME_TYPE_CODE,
                    $this->getQueryBuilder()->createNamedParameter($this->_getJobType()->getCode())
                ),
                $this->getQueryBuilder()->expr()->orX(
                    $this->getQueryBuilder()->expr()->eq(
                        JobInterface::FIELD_NAME_ASSIGNED_STATE,
                        $this->getQueryBuilder()->createNamedParameter(State\Service::STATE_WORKING)
                    ),
                    $this->getQueryBuilder()->expr()->eq(
                        JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                        $this->getQueryBuilder()->createNamedParameter(State\Service::STATE_WORKING)
                    )
                )
            )
        );

        return $this;
    }
}