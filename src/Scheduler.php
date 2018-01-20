<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Toolkit\Time;
use Cron\CronExpression;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Service\Create;

class Scheduler implements SchedulerInterface
{
    use Scheduler\Cache\AwareTrait;
    use Scheduler\Time\AwareTrait;
    use Message\Broker\AwareTrait;
    use Job\Collection\Scheduler\AwareTrait;
    use Job\Type\Collection\Scheduler\AwareTrait;
    use Time\AwareTrait;
    use Strict\AwareTrait;
    use Create\Factory\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    const PROP_LAST_SCHEDULED_DATE_TIME = 'last_scheduled_job';

    public function scheduleStaticJobs(): SchedulerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->testAndSetLock()) {
            try{
                if (!empty($this->_getSchedulerCache()->getScheduledMinutesNotInCache())) {
                    $this->_scheduleJobs();
                    $this->_publishNextAlarmValue();
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

    protected function _publishNextAlarmValue(): SchedulerInterface
    {
        if ($this->_hasLastScheduledDateTime()) {
            $lastScheduledDateTime = $this->_getLastScheduledDateTime();
            $distanceUntilNextAlarm = $lastScheduledDateTime->diff($this->_getTime()->getNow());
            $secondsUntilNextAlaarm = $distanceUntilNextAlarm->format('%s');
            $message = json_encode(['command' => "commandProcess.setAlarm(" . $secondsUntilNextAlaarm . ")"]);
            $this->_getMessageBroker()->publishMessage($message);
        }

        return $this;
    }

    protected function _scheduleJobs(): SchedulerInterface
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
                        $create = $this->_getJobServiceCreateFactory()->create();
                        $create->setJobTypeCode($typeCode);
                        $create->setWorkAtDateTime($unscheduledDateTime);
                        $create->save();
//                        $this->_setOrUpdateLastScheduledDateTime($unscheduledDateTime);
                    }
                }
            }
        }

        foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
            $this->_getSchedulerCache()->cacheScheduledMinutes($unscheduledDateTime);
        }

        return $this;
    }

    protected function _setOrUpdateLastScheduledDateTime(\DateTime $lastScheduledDateTime): SchedulerInterface
    {
        $this->_createOrUpdate(self::PROP_LAST_SCHEDULED_DATE_TIME, $lastScheduledDateTime);

        return $this;
    }

    protected function _hasLastScheduledDateTime(): bool
    {
        return $this->_exists(self::PROP_LAST_SCHEDULED_DATE_TIME);
    }

    protected function _getLastScheduledDateTime(): \DateTime
    {
        return $this->_read(self::PROP_LAST_SCHEDULED_DATE_TIME);
    }
}