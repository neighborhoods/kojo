<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Toolkit\Time;
use Cron\CronExpression;
use Neighborhoods\Toolkit\Data\Property\Strict;
use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Api;

class Scheduler implements SchedulerInterface
{
    use Scheduler\Cache\AwareTrait;
    use Job\Collection\Scheduler\AwareTrait;
    use Job\Type\Collection\Scheduler\AwareTrait;
    use Time\AwareTrait;
    use Strict\AwareTrait;
    use Api\V1\Service\Create\Factory\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;

    public function scheduleStaticJobs(): SchedulerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->testAndSetLock()) {
            try{
                if (!empty($this->_getSchedulerCache()->getMinutesNotInCache())) {
                    $this->_scheduleStaticJobs();
                }
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->releaseLock();
            }catch(\Exception $exception){
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _scheduleStaticJobs(): SchedulerInterface
    {
        $schedulerCache = $this->_getSchedulerCache();
        $this->_getSchedulerJobCollection()->setReferenceDateTime($this->_getTime()->getNow());
        foreach ($this->_getSchedulerJobTypeCollection()->getIterator() as $jobType) {
            $cronExpressionString = $jobType->getCronExpression();
            $typeCode = $jobType->getCode();
            $cronExpression = CronExpression::factory($cronExpressionString);
            foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
                if ($cronExpression->isDue($unscheduledDateTime)) {
                    if (!isset($this->_getSchedulerJobCollection()->getRecords()[$typeCode][$unscheduledMinute])) {
                        $create = $this->_getServiceCreateFactory()->create();
                        $create->setJobTypeCode($typeCode);
                        $create->setWorkAtDateTime($unscheduledDateTime);
                        $create->save();
                    }
                }
            }
        }

        foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
            $this->_getSchedulerCache()->cacheScheduledMinutes($unscheduledDateTime);
        }

        return $this;
    }
}