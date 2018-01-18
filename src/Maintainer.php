<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job\Collection\CrashDetection;
use NHDS\Jobs\Data\Job\Service\Update;
use NHDS\Jobs\Data\Job\Collection\Schedule\LimitCheck;
use NHDS\Jobs\Data\Job\Collection\ScheduleLimit;
use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;
use NHDS\Jobs\Process\Pool\Logger;

class Maintainer implements MaintainerInterface
{
    use Strict\AwareTrait;
    use CrashDetection\AwareTrait;
    use Maintainer\Delete\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use LimitCheck\AwareTrait;
    use ScheduleLimit\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    use FailedSCheduleLimitCheck\Factory\AwareTrait;
    use Update\Wait\Factory\AwareTrait;
    use Update\Crash\Factory\AwareTrait;
    use Update\Panic\Factory\AwareTrait;
    use Logger\AwareTrait;

    public function delete(): MaintainerInterface
    {
        $this->_getMaintainerDelete()->deleteCompletedJobs();

        return $this;
    }

    public function rescheduleCrashedJobs(): MaintainerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->testAndSetLock()) {
            try{
                $this->_rescheduleCrashedJobs();
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->releaseLock();
            }catch(\Exception $exception){
                $this->_getLogger()->debug('Received Exception with message "' . $exception->getMessage() . '"');
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _rescheduleCrashedJobs(): Maintainer
    {
        foreach ($this->_getJobCollectionCrashDetection()->getIterator() as $job) {
            $jobSemaphoreResource = $this->_getNewJobOwnerResource($job);
            try{
                if ($jobSemaphoreResource->testAndSetLock()) {
                    $crashUpdate = $this->_getJobServiceUpdateCrashFactory()->create();
                    $crashUpdate->setJob($job);
                    $crashUpdate->save();
                    $jobSemaphoreResource->releaseLock();
                }
            }catch(\Exception $exception){
                $this->_getLogger()->debug('Received Exception with message "' . $exception->getMessage() . '"');
                if ($jobSemaphoreResource->hasLock()) {
                    $jobSemaphoreResource->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    public function updatePendingJobs(): MaintainerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->testAndSetLock()) {
            try{
                $this->_updatePendingJobs();
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->releaseLock();
            }catch(\Exception $exception){
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _updatePendingJobs(): Maintainer
    {
        foreach ($this->_getJobCollectionScheduleLimitCheck()->getIterator() as $job) {
            $jobType = $this->_getJobTypeRepository()->getJobType($job->getTypeCode());
            $scheduleLimit = $this->_getJobCollectionScheduleLimitByJobType($jobType);
            $numberOfScheduledJobs = $scheduleLimit->getNumberOfCurrentlyScheduledJobs();
            try{
                if ($numberOfScheduledJobs < $jobType->getScheduleLimit()) {
                    $waitUpdate = $this->_getJobServiceUpdateWaitFactory()->create();
                    $waitUpdate->setJob($job);
                    $waitUpdate->save();
                }else {
                    $failedLimitCheckUpdate = $this->_getUpdateCompleteFailedScheduleLimitCheckFactory()->create();
                    $failedLimitCheckUpdate->setJob($job);
                    $failedLimitCheckUpdate->save();
                }
            }catch(\Exception $exception){
                $updatePanic = $this->_getJobServiceUpdatePanicFactory()->create();
                $updatePanic->setJob($job);
                $updatePanic->save();
                $this->_getLogger()->alert('Panicking Job[' . $job->getId() . '].');
            }
        }

        return $this;
    }
}