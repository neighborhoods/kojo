<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Cron\CronExpression;
use Neighborhoods\Kojo\Api;

class Scheduler implements SchedulerInterface
{
    use Scheduler\Cache\AwareTrait;
    use Time\AwareTrait;
    use Job\Repository\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    use Service\Create\Builder\Factory\AwareTrait;
    use Semaphore\Resource\Repository\AwareTrait;
    use Semaphore\Resource\Owner\Job\Factory\AwareTrait;

    public function scheduleStaticJobs(): SchedulerInterface
    {
        $semaphoreResourceRepository = $this->getSemaphoreResourceRepository();
        $scheduleSemaphoreResource = $semaphoreResourceRepository->get(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE);
        if ($scheduleSemaphoreResource->testAndSetLock()) {
            try {
                if (!empty($this->getSchedulerCache()->getMinutesNotInCache())) {
                    $this->_scheduleStaticJobs();
                }
                $scheduleSemaphoreResource->releaseLock();
            } catch (\Exception $exception) {
                if ($scheduleSemaphoreResource->hasLock()) {
                    $scheduleSemaphoreResource->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _scheduleStaticJobs(): SchedulerInterface
    {
        $schedulerCache = $this->getSchedulerCache();
        foreach ($this->getJobTypeRepository()->getAll() as $jobType) {
            $cronExpressionString = $jobType->getCronExpression();
            $typeCode = $jobType->getTypeCode();
            $cronExpression = CronExpression::factory($cronExpressionString);
            foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
                if ($cronExpression->isDue($unscheduledDateTime)) {
                    if (!isset($this->getJobRepository()->getScheduledMap()[$typeCode . $unscheduledMinute])) {
                        $create = $this->getServiceCreateBuilderFactory()->create()->build();
                        $create->setJobTypeCode($typeCode);
                        $create->setWorkAtDateTime($unscheduledDateTime);
                        $create->save();
                    }
                }
            }
        }

        foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
            $this->getSchedulerCache()->cacheScheduledMinutes($unscheduledDateTime);
        }

        return $this;
    }
}