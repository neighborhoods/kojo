<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Semaphore\ResourceInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use Zend\Db\Sql\Select;
use NHDS\Jobs\Message\Broker;
use NHDS\Jobs\Semaphore;

class Selector implements SelectorInterface
{
    use Crud\AwareTrait;
    use Broker\AwareTrait;
    use Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\AwareTrait;
    use Collection\AwareTrait;
    const PROP_PREPARED_COLLECTION = 'prepared_collection';
    const PROP_PAGE_SIZE           = 'page_size';
    const PROP_OFFSET              = 'offset';
    const PROP_NEXT_JOB_TO_WORK    = 'next_job_to_work';
    protected $_pickingCycles = 0;

    public function getNextJobToWork(): JobInterface
    {
        return $this->_read(self::PROP_NEXT_JOB_TO_WORK);
    }

    public function hasWorkableJob(): bool
    {
        $this->pick();

        return $this->_exists(self::PROP_NEXT_JOB_TO_WORK);
    }

    public function pick(): SelectorInterface
    {
        $select = $this->_getPreparedCollection()->getSelect();
        $select->offset($this->_pickingCycles * $this->_getPageSize());
        $jobCandidateRecords = $this->_getPreparedCollection()->getRecords();

        if (count($jobCandidateRecords) > 1) {
            $this->_getBroker()->publishMessage(count($jobCandidateRecords));
        }

        while (!empty($jobCandidateRecords)) {
            // Find and obtain a job mutex.
            foreach ($jobCandidateRecords as $jobCandidateRecord) {
                $jobSemaphoreResource = $this->_getJobSemaphoreResource();
                $resourceName = ($jobCandidateRecord[JobInterface::FIELD_NAME_CAN_RUN_IN_PARALLEL] == 1)
                    ? $jobCandidateRecord[JobInterface::FIELD_NAME_ID]
                    : 'job';
                $jobSemaphoreResource->setResourceName($resourceName);
                $jobSemaphoreResource->setResourcePath($jobCandidateRecord[JobInterface::FIELD_NAME_TYPE_CODE]);
                if ($this->_getSemaphore()->testAndSetLock($jobSemaphoreResource)) {
                    $job = $this->_getJobClone();
                    $job->setIdPropertyName(JobInterface::FIELD_NAME_ID);
                    $job->setId($jobCandidateRecord[JobInterface::FIELD_NAME_ID]);
                    $this->_create(self::PROP_NEXT_JOB_TO_WORK, $job);
                    break 2;
                }
                continue;
            }
            ++$this->_pickingCycles;
            $select->offset($this->_pickingCycles * $this->_getPageSize());
            $jobCandidateRecords = $this->_getPreparedCollection()->getRecords();
        }

        return $this;
    }

    protected function _getPreparedCollection(): Collection
    {
        if (!$this->_exists(self::PROP_PREPARED_COLLECTION)) {
            $select = $this->_getCollection()->getSelect();
            $select->where([JobInterface::FIELD_NAME_ASSIGNED_STATE => ServiceInterface::STATE_WAIT]);
            $select->columns(
                [
                    JobInterface::FIELD_NAME_ID,
                    JobInterface::FIELD_NAME_TYPE_CODE,
                    JobInterface::FIELD_NAME_CAN_RUN_IN_PARALLEL,
                ]
            );
            $select->order(JobInterface::FIELD_NAME_PRIORITY . ' DESC');
            $select->where(JobInterface::FIELD_NAME_WORK_AT_DATETIME . ' <= utc_timestamp()');
            $this->_create(self::PROP_PREPARED_COLLECTION, $this->_getCollection());
        }

        return $this->_read(self::PROP_PREPARED_COLLECTION);
    }

    protected function _getPageSize(): int
    {
        return $this->_read(self::PROP_PAGE_SIZE);
    }

    public function setPageSize(int $pageSize): SelectorInterface
    {
        $this->_create(self::PROP_PAGE_SIZE, $pageSize);

        return $this;
    }

    protected function _getOffset(): int
    {
        return $this->_read(self::PROP_OFFSET);
    }

    public function setOffset(int $offset): SelectorInterface
    {
        $this->_create(self::PROP_OFFSET, $offset);

        return $this;
    }

    protected function _getJobSemaphoreResource(): ResourceInterface
    {
        return $this->_getSemaphoreResourceClone('job');
    }
}