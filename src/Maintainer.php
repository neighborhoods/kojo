<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job\Collection\CrashDetection;
use NHDS\Jobs\Semaphore\Resource;
use NHDS\Jobs\Data\Job\Service\Update\Crash;

class Maintainer implements MaintainerInterface
{
    use CrashDetection\AwareTrait;
    use Resource\Owner\Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Crash\AwareTrait;

    public function maintain(): MaintainerInterface
    {
        $this->_rescheduleCrashedJobs();
        $this->_updatePendingJobs();

        return $this;
    }

    protected function _rescheduleCrashedJobs(): Maintainer
    {
        foreach ($this->_getJobCollectionCrashDetection()->getIterator() as $job) {
            $jobSemaphoreResource = $this->_getNewJobOwnerResource($job);
            if ($this->_getSemaphore()->testAndSetLock($jobSemaphoreResource)) {
                $crashUpdate = $this->_getJobServiceUpdateCrashClone();
                $crashUpdate->setJob($job);
                $crashUpdate->save();
            }
        }

        return $this;
    }

    protected function _updatePendingJobs(): Maintainer
    {
        return $this;
    }
}