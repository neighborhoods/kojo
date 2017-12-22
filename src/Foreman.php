<?php

namespace NHDS\Jobs;

use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Db;
use NHDS\Jobs\Message;
use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Selector;
use NHDS\Jobs\Worker\Locator;
use NHDS\Jobs\Data\Job\Service\Update;

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
    use Update\Work\AwareTrait;
    use Update\Panic\AwareTrait;
    const PROP_JOB = 'job';

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
        $job->load();
        $this->_getLocator()->setJob($job);
        if (is_callable($this->_getLocator()->getCallable())) {
            try{
                $this->_getJobServiceUpdateWork()->setJob($job);
                $this->_getJobServiceUpdateWork()->save();
            }catch(\Exception $exception){
                $this->_getJobServiceUpdatePanic()->setJob($job);
                $this->_getJobServiceUpdatePanic()->save();
            }
            try{
                call_user_func($this->_getLocator()->getCallable());
            }catch(\Exception $e){

            }
        }else {
            $this->_getJobServiceUpdatePanic()->setJob($job);
            $this->_getJobServiceUpdatePanic()->save();
        }

        return $this;
    }
}
