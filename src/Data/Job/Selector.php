<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Message\Broker;
use NHDS\Jobs\Semaphore;

class Selector implements SelectorInterface
{
    use Strict\AwareTrait;
    use Broker\AwareTrait;
    use Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Collection\AwareTrait;
    use Collection\Selector\AwareTrait;
    use Job\State\Service\AwareTrait;
    const PROP_PAGE_SIZE        = 'page_size';
    const PROP_OFFSET           = 'offset';
    const PROP_NEXT_JOB_TO_WORK = 'next_job_to_work';
    protected $_collectionIterations = 0;

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
        $select->offset($this->_collectionIterations * $this->_getPageSize());
        $select->limit($this->_getPageSize());
        $jobCandidates = $this->_getSelectorJobCollection()->getModelsArray();
        $publishedMessages = $this->_getMessageBroker()->getPublishChannelLength();
        while ($publishedMessages < count($jobCandidates)) {
            $message = json_encode(['command' => "commandProcess.addProcess('job')"]);
            $this->_getMessageBroker()->publishMessage($message);
            ++$publishedMessages;
        }

        while (!empty($jobCandidates)) {
            foreach ($this->_getSelectorJobCollection()->getIterator() as $jobCandidate) {
                $jobSemaphoreResource = $this->_getNewJobOwnerResource($jobCandidate);
                if (random_int(0, 10) !== 10) {
                    if ($this->_getSemaphore()->testAndSetLock($jobSemaphoreResource)) {
                        $job = $this->_getJobClone();
                        $job->setId($jobCandidate->getId());
                        $job->load();
                        $stateService = $this->_getJobStateServiceClone();
                        $stateService->setJob($job);
                        $stateService->requestWork();
                        if ($stateService->isValidTransition()) {
                            $this->_create(self::PROP_NEXT_JOB_TO_WORK, $job);
                            break 2;
                        }else {
                            $this->_getSemaphore()->releaseLock($jobSemaphoreResource);
                        }
                    }
                }
            }
            ++$this->_collectionIterations;
            $select->offset($this->_collectionIterations * $this->_getPageSize());
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