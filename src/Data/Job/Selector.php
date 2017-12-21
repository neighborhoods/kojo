<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Message\Broker;
use NHDS\Jobs\Semaphore;
use NHDS\Jobs\Semaphore\Resource\Owner;

class Selector implements SelectorInterface
{
    use Crud\AwareTrait;
    use Broker\AwareTrait;
    use Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Collection\AwareTrait;
    use Collection\Selector\AwareTrait;
    use Owner\Job\AwareTrait;
    const PROP_PAGE_SIZE        = 'page_size';
    const PROP_OFFSET           = 'offset';
    const PROP_NEXT_JOB_TO_WORK = 'next_job_to_work';
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
        $select = $this->_getSelectorJobCollection()->getSelect();
        $select->offset($this->_pickingCycles * $this->_getPageSize());
        $select->limit($this->_getPageSize());
        $jobCandidates = $this->_getSelectorJobCollection()->getModelsArray();
        if (count($jobCandidates) > 1) {
            $this->_getBroker()->publishMessage(count($jobCandidates));
        }

        while (!empty($jobCandidates)) {
            foreach ($this->_getSelectorJobCollection()->getIterator() as $jobCandidate) {
                $jobSemaphoreResource = $this->_getNewJobOwnerResource($jobCandidate);
                if ($this->_getSemaphore()->testAndSetLock($jobSemaphoreResource)) {
                    $job = $this->_getJobClone();
                    $job->setId($jobCandidate->getId());
                    $this->_create(self::PROP_NEXT_JOB_TO_WORK, $job);
                    break 2;
                }
            }
            ++$this->_pickingCycles;
            $select->offset($this->_pickingCycles * $this->_getPageSize());
            $jobCandidates = $this->_getSelectorJobCollection()->getRecords();
        }

        return $this;
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
}