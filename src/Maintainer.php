<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data;
use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Data\Job\Collection\CrashDetection;
use Neighborhoods\Kojo\Data\Job\Collection\Schedule\LimitCheck;
use Neighborhoods\Kojo\Data\Job\Collection\ScheduleLimit;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;
use Neighborhoods\Kojo\Process\Pool\Logger;

class Maintainer implements MaintainerInterface
{
    use Defensive\AwareTrait;
    use CrashDetection\AwareTrait;
    use Maintainer\Delete\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use LimitCheck\AwareTrait;
    use ScheduleLimit\AwareTrait;
    use Type\Repository\AwareTrait;
    use FailedSCheduleLimitCheck\Factory\AwareTrait;
    use Update\Wait\Factory\AwareTrait;
    use Update\Crash\Factory\AwareTrait;
    use Update\Panic\Factory\AwareTrait;
    use Logger\AwareTrait;
    use Data\Job\AwareTrait;

    public function deleteCompletedJobs(): MaintainerInterface
    {
        $this->_getMaintainerDelete()->deleteCompletedJobs();

        return $this;
    }

    public function rescheduleCrashedJobs(): MaintainerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->testAndSetLock()) {
            try {
                $this->_rescheduleCrashedJobs();
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->releaseLock();
            } catch (\Throwable $throwable) {
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS)->releaseLock();
                }
                throw $throwable;
            }
        }

        return $this;
    }

    protected function _rescheduleCrashedJobs(): Maintainer
    {
        foreach ($this->_getJobCollectionCrashDetection()->getIterator() as $job) {
            $jobSemaphoreResource = $this->_getNewJobOwnerResource($job);
            try {
                if ($jobSemaphoreResource->testAndSetLock()) {
                    $mutuallyExcludedJob = $this->_getJobClone();
                    $mutuallyExcludedJob->setId($job->getId());
                    $mutuallyExcludedJob->load();
                    if ($mutuallyExcludedJob->getAssignedState() === State\Service::STATE_WORKING) {
                        $crashUpdate = $this->_getServiceUpdateCrashFactory()->create();
                        $crashUpdate->setJob($mutuallyExcludedJob);
                        $crashUpdate->save();
                    }
                    $jobSemaphoreResource->releaseLock();
                }
            } catch (\Throwable $throwable) {
                if ($jobSemaphoreResource->hasLock()) {
                    $jobSemaphoreResource->releaseLock();
                }
                throw $throwable;
            }
        }

        return $this;
    }

    public function updatePendingJobs(): MaintainerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->testAndSetLock()) {
            try {
                $this->_updatePendingJobs();
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->releaseLock();
            } catch (\Throwable $throwable) {
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS)->releaseLock();
                }
                throw $throwable;
            }
        }

        return $this;
    }

    protected function _updatePendingJobs(): Maintainer
    {
        foreach ($this->_getJobCollectionScheduleLimitCheck() as $job) {
            $jobType = $this->_getTypeRepository()->getJobType($job->getTypeCode());
            $scheduleLimitCollection = $this->_getJobCollectionScheduleLimitByJobType($jobType);
            $numberOfScheduledJobs = $scheduleLimitCollection->getNumberOfCurrentlyScheduledJobs();
            $scheduleLimit = $jobType->getScheduleLimit();
            try {
                if ($numberOfScheduledJobs < $scheduleLimit) {
                    $waitUpdate = $this->_getServiceUpdateWaitFactory()->create();
                    $waitUpdate->setJob($job);
                    $waitUpdate->save();
                    $scheduleLimitCollection->incrementNumberOfCurrentlyScheduledJobs();
                } elseif ($job->getWorkAtDateTime() < new \DateTime('now')) {
                    $failedLimitCheckUpdate = $this->_getServiceUpdateCompleteFailedScheduleLimitCheckFactory()->create();
                    $failedLimitCheckUpdate->setJob($job);
                    $failedLimitCheckUpdate->save();
                }
            } catch (\Throwable $throwable) {
                $updatePanic = $this->_getServiceUpdatePanicFactory()->create();
                $updatePanic->setJob($job);
                $updatePanic->save();
                $this->_getLogger()->alert('Panicking job with ID[' . $job->getId() . '].');
            }
        }

        return $this;
    }
}
