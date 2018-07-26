<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Exception\Runtime\Db\Model\LoadException;
use Neighborhoods\Kojo\Message\Broker;
use Neighborhoods\Kojo\Process;

class Selector implements SelectorInterface
{
    use Broker\AwareTrait;
    use Job\AwareTrait;
    use Job\Repository\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Semaphore\Resource\Owner\Job\Factory\AwareTrait;
    use State\Service\Factory\AwareTrait;
    use Process\AwareTrait;
    protected $collectionIterations = 0;
    protected $workableJob;
    protected $pageSize;
    protected $offset;
    protected $randomIntMax;

    public function getWorkableJob(): JobInterface
    {
        if ($this->workableJob === null) {
            throw new \LogicException('Workable job is not set.');
        }

        return $this->workableJob;
    }

    public function hasWorkableJob(): bool
    {
        $this->_attemptSelect();

        return $this->workableJob === null ? false : true;
    }

    protected function _attemptSelect(): SelectorInterface
    {
        $jobCandidates = $this->getJobRepository()->getSchedulerMap();
        $numberOfJobCandidates = count($jobCandidates);
        $publishedMessages = $this->getMessageBroker()->getPublishChannelLength();
        while (true) {
            $message = json_encode(['command' => "commandProcess.addProcess('job')"]);
            if ($publishedMessages >= $numberOfJobCandidates) {
                break;
            }
            $this->getMessageBroker()->publishMessage($message);
            $publishedMessages = $this->getMessageBroker()->getPublishChannelLength();
        }

        while (!empty($jobCandidates)) {
            foreach ($jobCandidates as $jobCandidate) {
                $jobResourceOwner = $this->getSemaphoreResourceOwnerJobFactory()->create()->setJob($jobCandidate);
                $semaphoreResource = $this->getSemaphoreResourceFactory()->create();
                $semaphoreResource->setSemaphoreResourceOwner($jobResourceOwner);
                if (random_int(0, $this->getRandomIntMax()) !== $this->getRandomIntMax()) {
                    if ($semaphoreResource->testAndSetLock()) {
                        try {
                            $job = $this->getJobRepository()->get($jobCandidate->getId());
                            $stateService = $this->getStateServiceFactory()->create();
                            $stateService->setJob($job);
                            $stateService->requestWork();
                            if ($stateService->isValidTransition()) {
                                $this->workableJob = $job;
                                break 2;
                            } else {
                                $semaphoreResource->releaseLock();
                            }
                        } catch (LoadException $loadException) {
                            if ($semaphoreResource->hasLock()) {
                                $semaphoreResource->releaseLock();
                            }
                        }
                    }
                }
            }
            ++$this->collectionIterations;
            $jobCandidates = $this->getJobRepository()->getSchedulerMap();
        }

        return $this;
    }

    protected function getPageSize(): int
    {
        if ($this->pageSize === null) {
            throw new \LogicException('Page size is not set.');
        }

        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): SelectorInterface
    {
        if ($this->pageSize === null) {
            $this->pageSize = $pageSize;
        } else {
            throw new \LogicException('Page size is already set.');
        }

        return $this;
    }

    protected function getOffset(): int
    {
        if ($this->offset === null) {
            throw new \LogicException('Offset is not set.');
        }

        return $this->offset;
    }

    public function setOffset(int $offset): SelectorInterface
    {
        if ($this->offset === null) {
            $this->offset = $offset;
        } else {
            throw new \LogicException('Offset is already set.');
        }

        return $this;
    }

    public function setRandomIntMax(int $randomIntMax): SelectorInterface
    {
        if ($this->randomIntMax === null) {
            $this->randomIntMax = $randomIntMax;
        } else {
            throw new \LogicException('Random int max is already set.');
        }

        return $this;
    }

    protected function getRandomIntMax(): int
    {
        if ($this->randomIntMax === null) {
            throw new \LogicException('Random int max is not set.');
        }

        return $this->randomIntMax;
    }
}