<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Db;
use NHDS\Toolkit\Time;
use Cron\CronExpression;
use NHDS\Jobs\CacheItemPool;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Service\Create;

class Scheduler implements SchedulerInterface
{
    use Job\Collection\Scheduler\AwareTrait;
    use Job\Type\Collection\Scheduler\AwareTrait;
    use CacheItemPool\AwareTrait;
    use Db\Connection\Container\AwareTrait;
    use Time\AwareTrait;
    use Crud\AwareTrait;
    use Create\AwareTrait;
    const DATE_TIME_FORMAT_CACHE_MINUTE        = 'Y_m_d_H_i';
    const DATE_TIME_FORMAT_MYSQL_MINUTE        = 'Y-m-d H:i:0';
    const CACHE_SCHEDULED_AHEAD_VALUE          = 'scheduled';
    const CACHE_SCHEDULE_TAG_NAMESPACE         = 'nhds_jobs';
    const CACHE_SCHEDULED_AHEAD_KEY_PREFIX     = 'schedule_';
    const PROP_CACHE_ADAPTER                   = 'cache_adapter';
    const PROP_JOB_TYPES                       = 'job_types';
    const PROP_MINUTES_SCHEDULED_AHEAD_FOR     = 'minutes_scheduled_ahead_for';
    const PROP_SCHEDULED_KEY_LIFETIME          = 'scheduled_key_lifetime';
    const PROP_REFERENCE_DATE_TIME_CLONE       = 'reference_date_time_clone';
    const PROP_REFERENCE_DISTANCE_DATE_TIME    = 'reference_distance_date_time';
    const PROP_NEXT_REFERENCE_MINUTE_DATE_TIME = 'next_reference_minute_date_time';
    const SCHEDULER_COLLECTION_NAME            = 'scheduler_collection';
    protected $_scheduledKeyLifetime;
    protected $_scheduleMinutesNotInCache = [];
    protected $_existingJobs;

    public function schedule(): SchedulerInterface
    {
        if (!empty($this->_getScheduledMinutesNotInCache())) {
            $this->_scheduleJobs();
        }

        return $this;
    }

    protected function _getScheduledMinutesNotInCache()
    {
        if (empty($this->_scheduleMinutesNotInCache)) {
            $nexReferenceMinuteDateTime = $this->_getNextReferenceMinuteDateTime();
            while ($this->_getReferenceDistanceDateTime() >= $nexReferenceMinuteDateTime) {
                if (!$this->_isMinuteScheduledInCache($nexReferenceMinuteDateTime)) {
                    $scheduleMinute = $nexReferenceMinuteDateTime;
                    $this->_scheduleMinutesNotInCache[] = $scheduleMinute;
                }
                $nexReferenceMinuteDateTime = $this->_getNextReferenceMinuteDateTime();
            }
        }

        return $this->_scheduleMinutesNotInCache;
    }

    protected function _isMinuteScheduledInCache(\DateTime $referenceMinuteDateTime): bool
    {
        $isMinuteScheduled = false;
        $referenceMinuteDateTimeString = $referenceMinuteDateTime->format(self::DATE_TIME_FORMAT_CACHE_MINUTE);
        $cacheItemPool = $this->_getCacheItemPool();
        $hasItem = $cacheItemPool->hasItem(self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX . $referenceMinuteDateTimeString);
        if ($hasItem) {
            $isMinuteScheduled = true;
        }

        return $isMinuteScheduled;
    }

    protected function _scheduleJobs(): SchedulerInterface
    {
        $this->_getSchedulerJobCollection()->setReferenceDateTime($this->_getReferenceDateTimeClone());
        foreach ($this->_getSchedulerJobTypeCollection()->getIterator() as $jobType) {
            $cronExpressionString = $jobType->getCronExpression();
            $typeCode = $jobType->getCode();
            $cron = CronExpression::factory($cronExpressionString);
            $nextRunDateTime = $cron->getNextRunDate();
            foreach ($this->_scheduleMinutesNotInCache as $unscheduledMinute => $unscheduledDateTime) {
                if ($nextRunDateTime == $unscheduledDateTime) {
                    if (!isset($this->_getSchedulerJobCollection()->getRecords()[$typeCode][$unscheduledMinute])) {
                        $this->_getJobServiceCreate()->setJobTypeCode($typeCode);
                        $this->_getJobServiceCreate()->setWorkAtDateTime($unscheduledDateTime);
                        $this->_getJobServiceCreate()->save();
                    }
                }
            }
        }

        foreach ($this->_scheduleMinutesNotInCache as $unscheduledMinute => $unscheduledDateTime) {
            $this->_cacheScheduledMinutes($unscheduledMinute);
        }

        return $this;
    }

    protected function _getScheduledKeyLifetime(): \DateTime
    {
        if ($this->_exists(self::PROP_SCHEDULED_KEY_LIFETIME)) {
            $now = $this->_getTime()->getNow();
            $lifetimeSeconds = 5 * 60 + $this->_getMinutesToScheduleAheadFor();
            $dateInterval = new \DateInterval('PT' . $lifetimeSeconds . 'S');
            $this->_create(self::PROP_SCHEDULED_KEY_LIFETIME, $now->add($dateInterval));
        }

        return $this->_read(self::PROP_SCHEDULED_KEY_LIFETIME);
    }

    protected function _cacheScheduledMinutes(string $time): SchedulerInterface
    {
        $cacheItemPool = $this->_getCacheItemPool();
        $cacheItem = $cacheItemPool->getItem(self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX . $time);
        $cacheItem->set(self::CACHE_SCHEDULED_AHEAD_VALUE);
        $cacheItem->expiresAt($this->_getScheduledKeyLifetime());
        $cacheItemPool->save($cacheItem);

        return $this;
    }

    protected function _getReferenceDistanceDateTime(): \DateTime
    {
        if (!$this->_exists(self::PROP_REFERENCE_DISTANCE_DATE_TIME)) {
            $minutesToScheduleAheadFor = $this->_getMinutesToScheduleAheadFor();
            $minutesToScheduleAheadForDateTimeInterval = new \DateInterval('PT' . $minutesToScheduleAheadFor . 'M');
            $referenceDateTime = $this->_getReferenceDateTimeClone();
            $referenceDistanceDateTime = $referenceDateTime->add($minutesToScheduleAheadForDateTimeInterval);

            $this->_create(self::PROP_REFERENCE_DISTANCE_DATE_TIME, $referenceDistanceDateTime);
        }

        return $this->_read(self::PROP_REFERENCE_DISTANCE_DATE_TIME);
    }

    protected function _getReferenceDateTimeClone(): \DateTime
    {
        if (!$this->_exists(self::PROP_REFERENCE_DATE_TIME_CLONE)) {
            $this->_create(self::PROP_REFERENCE_DATE_TIME_CLONE, $this->_getTime()->getNow());
        }

        return $this->_read(self::PROP_REFERENCE_DATE_TIME_CLONE);
    }

    protected function _getNextReferenceMinuteDateTime(): \DateTime
    {
        if (!$this->_exists(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME)) {
            $referenceDateTime = $this->_getReferenceDateTimeClone();
            $referenceDateTimeMinuteString = $referenceDateTime->format(self::DATE_TIME_FORMAT_MYSQL_MINUTE);
            $nextReferenceMinuteDateTime = new \DateTime($referenceDateTimeMinuteString);
            $this->_create(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME, $nextReferenceMinuteDateTime);
        }else {
            /** @var \DateTime $nextReferenceMinuteDateTime */
            $nextReferenceMinuteDateTime = $this->_read(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME);
            $nextReferenceMinuteDateTime->add(new \DateInterval('PT1M'));
        }

        return clone $this->_read(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME);
    }

    protected function _getMinutesToScheduleAheadFor(): int
    {
        if (!$this->_exists(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR)) {
            $this->_create(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR, 1);
        }

        return $this->_read(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR);
    }

    public function setMinutesToScheduleAheadFor(int $minutesScheduledAheadFor): SchedulerInterface
    {
        $this->_create(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR, $minutesScheduledAheadFor);

        return $this;
    }
}