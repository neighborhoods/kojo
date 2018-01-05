<?php

namespace NHDS\Jobs;

use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Db;
use NHDS\Jobs\Message;
use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Selector;
use NHDS\Jobs\Worker\Locator;
use NHDS\Jobs\Data\Job\Service\Update;
use NHDS\Jobs\Process\Pool\Logger;

class Foreman implements ForemanInterface
{
    use Crud\AwareTrait;
    use Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Message\Broker\AwareTrait;
    use Db\Connection\Container\AwareTrait;
    use Selector\AwareTrait;
    use Locator\AwareTrait;
    use Update\Work\Factory\AwareTrait;
    use Update\Panic\Factory\AwareTrait;
    use Update\Crash\Factory\AwareTrait;
    use Logger\AwareTrait;

    public function work(): ForemanInterface
    {
        if ($this->_getSelector()->hasWorkableJob()) {
            $this->_workWorker();
        }

        return $this;
    }

    protected function _workWorker(): ForemanInterface
    {
        $job = $this->_getSelector()->getNextJobToWork();
        $this->_getLocator()->setJob($job);
        if (is_callable($this->_getLocator()->getCallable())) {
            try{
                $updateWork = $this->_getJobServiceUpdateWorkFactory()->create();
                $updateWork->setJob($job);
                $updateWork->save();
            }catch(\Exception $exception){
                $updatePanic = $this->_getJobServiceUpdatePanicFactory()->create();
                $updatePanic->setJob($job);
                $updatePanic->save();
                throw $exception;
            }
            try{
                $this->_getLogger()->debug('Instantiating Worker for Job[' . $job->getId() . '].');
                call_user_func($this->_getLocator()->getCallable());
            }catch(\Exception $e){
                $updateCrash = $this->_getJobServiceUpdateCrashFactory()->create();
                $updateCrash->setJob($job);
                $updateCrash->save();
            }
        }else {
            $updatePanic = $this->_getJobServiceUpdatePanicFactory()->create();
            $updatePanic->setJob($job);
            $updatePanic->save();
        }

        return $this;
    }
}