<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Service;

class Maintainer implements MaintainerInterface
{
    use Maintainer\Delete\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Job\Repository\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    use Service\Update\Complete\FailedScheduleLimitCheck\Factory\AwareTrait;
    use Service\Update\Wait\Factory\AwareTrait;
    use Service\Update\Crash\Factory\AwareTrait;
    use Service\Update\Panic\Factory\AwareTrait;
    use Logger\AwareTrait;
    use Semaphore\Resource\Repository\AwareTrait;
    use Semaphore\Resource\Owner\Job\Factory\AwareTrait;

    public function deleteCompletedJobs(): MaintainerInterface
    {
        $this->getMaintainerDelete()->deleteCompletedJobs();

        return $this;
    }

    public function rescheduleCrashedJobs(): MaintainerInterface
    {
        $semaphoreResourceRepository = $this->getSemaphoreResourceRepository();
        $rescheduleJobsResource = $semaphoreResourceRepository->get(self::SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS);
        if ($rescheduleJobsResource->testAndSetLock()) {
            try {
                $this->_rescheduleCrashedJobs();
                $rescheduleJobsResource->releaseLock();
            } catch (\Exception $exception) {
                if ($rescheduleJobsResource->hasLock()) {
                    $rescheduleJobsResource->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _rescheduleCrashedJobs(): Maintainer
    {
        foreach ($this->getJobRepository()->getWorkingMap() as $job) {
            $jobResourceOwner = $this->getSemaphoreResourceOwnerJobFactory()->create()->setJob($job);
            $semaphoreResource = $this->getSemaphoreResourceFactory()->create();
            $semaphoreResource->setSemaphoreResourceOwner($jobResourceOwner);
            try {
                if ($semaphoreResource->testAndSetLock()) {
                    $crashUpdate = $this->getServiceUpdateCrashFactory()->create();
                    $crashUpdate->setJob($job);
                    $crashUpdate->save();
                    $semaphoreResource->releaseLock();
                }
            } catch (\Exception $exception) {
                if ($semaphoreResource->hasLock()) {
                    $semaphoreResource->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    public function updatePendingJobs(): MaintainerInterface
    {
        $semaphoreResourceRepository = $this->getSemaphoreResourceRepository();
        $updatePendingJobsResource = $semaphoreResourceRepository->get(self::SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS);
        if ($updatePendingJobsResource->testAndSetLock()) {
            try {
                $this->_updatePendingJobs();
                $updatePendingJobsResource->releaseLock();
            } catch (\Exception $exception) {
                if ($updatePendingJobsResource->hasLock()) {
                    $updatePendingJobsResource->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _updatePendingJobs(): Maintainer
    {
        foreach ($this->getJobRepository()->getScheduleLimitCheckMap() as $job) {
            $jobType = $this->getJobTypeRepository()->get($job->getTypeCode());
            $scheduleLimitCollection = $this->_getJobCollectionScheduleLimitByJobType($jobType);
            $numberOfScheduledJobs = $scheduleLimitCollection->getNumberOfCurrentlyScheduledJobs();
            $scheduleLimit = $jobType->getScheduleLimit();
            try {
                if ($numberOfScheduledJobs < $scheduleLimit) {
                    $waitUpdate = $this->getServiceUpdateWaitFactory()->create();
                    $waitUpdate->setJob($job);
                    $waitUpdate->save();
                    $scheduleLimitCollection->incrementNumberOfCurrentlyScheduledJobs();
                } elseif ($job->getWorkAtDateTime() < new \DateTime('now')) {
                    $failedLimitCheckUpdate = $this->getServiceUpdateCompleteFailedScheduleLimitCheckFactory()->create();
                    $failedLimitCheckUpdate->setJob($job);
                    $failedLimitCheckUpdate->save();
                }
            } catch (\Exception $exception) {
                $updatePanic = $this->getServiceUpdatePanicFactory()->create();
                $updatePanic->setJob($job);
                $updatePanic->save();
                $this->getLogger()->alert('Panicking job with ID[' . $job->getId() . '].');
            }
        }

        return $this;
    }
}