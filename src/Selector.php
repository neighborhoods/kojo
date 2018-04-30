<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Exception\Runtime\Db\Model\LoadException;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Message\Broker;
use Neighborhoods\Kojo\Process;

class Selector implements SelectorInterface
{
    use Defensive\AwareTrait;
    use Broker\AwareTrait;
    use Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Job\Collection\Selector\AwareTrait;
    use State\Service\AwareTrait;
    use Process\AwareTrait;
    protected $_collectionIterations = 0;

    public function getWorkableJob(): JobInterface
    {
        return $this->_read(self::PROP_NEXT_JOB_TO_WORK);
    }

    public function hasWorkableJob(): bool
    {
        $this->_attemptSelect();

        return $this->_exists(self::PROP_NEXT_JOB_TO_WORK);
    }

    protected function _attemptSelect(): SelectorInterface
    {
        $select = $this->_getSelectorJobCollection()->getSelect();
        $select->offset($this->_collectionIterations * $this->_getPageSize());
        $select->limit($this->_getPageSize());
        $jobCandidates = $this->_getSelectorJobCollection()->getModelsArray();
        $numberOfJobCandidates = count($jobCandidates);
        while (true) {
            $message = json_encode(['command' => "commandProcess.addProcess('job')"]);
            $this->_getMessageBroker()->publishMessage($message);
            $publishedMessages = $this->_getMessageBroker()->getPublishChannelLength();
            if ($publishedMessages >= $numberOfJobCandidates) {
                break;
            }
        }

        while (!empty($jobCandidates)) {
            foreach ($this->_getSelectorJobCollection()->getIterator() as $jobCandidate) {
                $jobSemaphoreResource = $this->_getNewJobOwnerResource($jobCandidate);
                if (random_int(0, $this->_getRandomIntMax()) !== $this->_getRandomIntMax()) {
                    if ($this->_getSemaphore()->testAndSetLock($jobSemaphoreResource)) {
                        $job = $this->_getJobClone();
                        $job->setId($jobCandidate->getId());
                        try{
                            $job->load();
                            $stateService = $this->_getStateServiceClone();
                            $stateService->setJob($job);
                            $stateService->requestWork();
                            if ($stateService->isValidTransition()) {
                                $this->_create(self::PROP_NEXT_JOB_TO_WORK, $job);
                                break 2;
                            }else {
                                $this->_getSemaphore()->releaseLock($jobSemaphoreResource);
                            }
                        }catch(LoadException $loadException){
                            if ($this->_getSemaphore()->hasLock($jobSemaphoreResource)) {
                                $this->_getSemaphore()->releaseLock($jobSemaphoreResource);
                            }
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

    public function setRandomIntMax(int $randomIntMax): SelectorInterface
    {
        $this->_create(self::PROP_RANDOM_INT_MAX, $randomIntMax);

        return $this;
    }

    protected function _getRandomIntMax(): int
    {
        return $this->_read(self::PROP_RANDOM_INT_MAX);
    }
}