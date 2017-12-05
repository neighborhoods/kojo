<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Property\Crud;
use NHDS\Jobs\Db;
use NHDS\Jobs\Message;
use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Selector;

class Foreman implements ForemanInterface
{
    use Crud\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\AwareTrait;
    use Message\Broker\AwareTrait;
    use Db\Connection\Container\AwareTrait;
    use Selector\AwareTrait;
    const PROP_JOB = 'job';

    public function work(): ForemanInterface
    {
        $this->_maintain();
        $this->_schedule();
        if ($this->_getSelector()->hasWorkableJob()) {
            $this->_workWorker();
        }

        return $this;
    }

    protected function _workWorker()
    {
        $job = $this->_getSelector()->getNextJobToWork();
    }

    protected function _schedule(): ForemanInterface
    {
        if ($this->_getSemaphore()->testAndSetLock($this->_getScheduleSemaphoreResource())) {
            try{
                $this->_getScheduler()->schedule();
            }catch(\Exception $exception){
                $this->_getSemaphore()->releaseLock($this->_getScheduleSemaphoreResource());
                throw $exception;
            }
            $this->_getSemaphore()->releaseLock($this->_getScheduleSemaphoreResource());
        }

        return $this;
    }

    protected function _maintain(): ForemanInterface
    {
        if ($this->_getSemaphore()->testAndSetLock($this->_getMaintainSemaphoreResource())) {
            try{
                $this->_getMaintainer()->maintain();
            }catch(\Exception $exception){
                $this->_getSemaphore()->releaseLock($this->_getMaintainSemaphoreResource());
                throw $exception;
            }
            $this->_getSemaphore()->releaseLock($this->_getMaintainSemaphoreResource());
        }

        return $this;
    }

    protected function _getMaintainSemaphoreResource(): Semaphore\ResourceInterface
    {
        return $this->_getSemaphoreResource(self::MAINTAIN_SEMAPHORE_RESOURCE_NAME);
    }

    protected function _getScheduleSemaphoreResource(): Semaphore\ResourceInterface
    {
        return $this->_getSemaphoreResource(self::SCHEDULE_SEMAPHORE_RESOURCE_NAME);
    }
}
