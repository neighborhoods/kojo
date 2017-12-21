<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job\Collection\CrashDetection;
use NHDS\Jobs\Data\Job\Service\Update;
use NHDS\Jobs\Semaphore\Resource;
use NHDS\Jobs\Data\Job\Collection\Pending\LimitCheck;
use NHDS\Jobs\Data\Job\Collection\ScheduleLimit;
use NHDS\Jobs\Data\Job\Type\Repository;
use NHDS\Jobs\Data\Job\Service\Update\Work;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck;

class Maintainer implements MaintainerInterface
{
    use Crud\AwareTrait;
    use CrashDetection\AwareTrait;
    use Resource\Owner\Job\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use LimitCheck\AwareTrait;
    use ScheduleLimit\AwareTrait;
    use Repository\AwareTrait;
    use Work\AwareTrait;
    use FailedLimitCheck\AwareTrait;
    use Update\Crash\Factory\AwareTrait;

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
                $crashUpdate = $this->_getJobServiceUpdateCrashFactory()->create();
                $crashUpdate->setJob($job);
                $crashUpdate->save();
            }
        }

        return $this;
    }

    protected function _updatePendingJobs(): Maintainer
    {
        foreach ($this->_getJobCollectionLimitCheck()->getIterator() as $job) {
            $jobType = $this->_getJobTypeRepository()->getJobType($job->getTypeCode());
            $scheduleLimit = $this->_getJobCollectionScheduleLimitByJobType($jobType);
            $numberOfScheduledJobs = $scheduleLimit->getNumberOfCurrentlyScheduledJobs();
            if ($numberOfScheduledJobs < $jobType->getScheduleLimit()) {
                $workUpdate = $this->_getJobServiceUpdateWorkClone();
                $workUpdate->setJob($job);
                $workUpdate->save();
            }else {
                $failedLimitCheckUpdate = $this->_getJobServiceUpdateFailedLimitCheckClone();
                $failedLimitCheckUpdate->setJob($job);
                $failedLimitCheckUpdate->save();
            }
        }

        return $this;
    }
}