<?php

namespace NHDS\Jobs;

use Cron\CronExpression;
use Psr\Cache\CacheItemPoolInterface;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Data\Property\Crud;
use NHDS\Jobs\Db;

class Scheduler implements SchedulerInterface
{
    use Db\Connection\Container\AwareTrait;
    use Time\AwareTrait;
    use Crud\AwareTrait;
    const DATE_TIME_FORMAT_CACHE_MINUTE     = 'Y_m_d_H_i';
    const DATE_TIME_FORMAT_MYSQL_MINUTE     = 'Y-m-d H:i:0';
    const CACHE_SCHEDULED_AHEAD_VALUE       = 'scheduled';
    const CACHE_SCHEDULE_TAG_NAMESPACE      = 'nhds_jobs';
    const CACHE_SCHEDULED_AHEAD_KEY_PREFIX  = 'schedule_';
    const PROP_CACHE_ADAPTER                = 'cache_adapter';
    const PROP_CACHE_ITEM_POOL              = 'cache_item_pool';
    const PROP_JOB_TYPES                    = 'job_types';
    const PROP_MINUTES_SCHEDULED_AHEAD_FOR  = 'minutes_scheduled_ahead_for';
    const PROP_SCHEDULED_KEY_LIFETIME       = 'scheduled_key_lifetime';
    const PROP_REFERENCE_DATE_TIME          = 'reference_date_time';
    const PROP_REFERENCE_DISTANCE_DATE_TIME = 'reference_distance_date_time';
    protected $_scheduledKeyLifetime;
    protected $_unscheduledMinutes = [];
    protected $_existingJobs;

    public function schedule(): SchedulerInterface
    {
        if (!empty($this->_getUnscheduledMinutes())) {
            $this->_scheduleJobs();
        }

        return $this;
    }

    protected function _getJobTypes(): array
    {
        if (!$this->_exists(self::PROP_JOB_TYPES)) {
            $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB);
        }

        return $this->_read(self::PROP_JOB_TYPES);
    }

    protected function _getUnscheduledMinutes()
    {
        if (empty($this->_unscheduledMinutes)) {
            $nexReferenceMinuteDateTime = $this->_getNextReferenceMinuteDateTime();
            while ($this->_getReferenceDistanceDateTime() >= $nexReferenceMinuteDateTime) {
                if ($this->_isMinuteScheduled($nexReferenceMinuteDateTime)) {
                    continue;
                }else {
                    $this->_unscheduledMinutes[$minute] = $time;
                }
            }
        }

        return $this->_unscheduledMinutes;
    }

    protected function _isMinuteScheduled(\DateTime $referenceMinuteDateTime): bool
    {
        $isMinnuteScheduled = false;
        $referenceMinuteDateTimeString = $referenceMinuteDateTime->format(self::DATE_TIME_FORMAT_CACHE_MINUTE);
        $cacheItemPool = $this->_getCacheItemPool();
        $hasItem = $cacheItemPool->hasItem(self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX . $referenceMinuteDateTimeString);
        if (!$hasItem) {
//            if (){}
        }

        return $isMinuteScheduled;
    }

    protected function _scheduleJobs()
    {
        foreach ($this->_getJobTypes() as $jobType) {
            $cron = CronExpression::factory('3-59/15 2,6-12 */15 1 2-5');
            $ime3 = $cron->getNextRunDate()->format('Y-m-d H:i:s');

            foreach ($this->_unscheduledMinutes as $unscheduledMinute => $time) {
                if (isset($this->_existingJobs[$jobType['code']][$unscheduledMinute])) {
                    // already scheduled
                    continue;
                }
                if (!$this->_getScheduleClone()->trySchedule($time)) {
                    // time does not match cron expression
                    continue;
                }
                // @bwilson - schedule
            }
        }

        foreach ($this->_unscheduledMinutes as $unscheduledMinute => $time) {
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

    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool): SchedulerInterface
    {
        $this->_create(self::PROP_CACHE_ITEM_POOL, $cacheItemPool);

        return $this;
    }

    protected function _getCacheItemPool(): CacheItemPoolInterface
    {
        return $this->_read(self::PROP_CACHE_ITEM_POOL);
    }

    protected function _getExistingJobs(): SchedulerInterface
    {
        $minutesToScheduleAheadFor = $this->_getMinutesToScheduleAheadFor();
        $referenceDateTime = $this->_getTime()->getNow();
        $dateInterval = new \DateInterval('PT' . $minutesToScheduleAheadFor . 'M');
        $referenceDateTime->add($dateInterval);

        return $this;
    }

    protected function _getReferenceDistanceDateTime(): \DateTime
    {
        if (!$this->_exists(self::PROP_REFERENCE_DISTANCE_DATE_TIME)) {
            $minutesToScheduleAheadFor = $this->_getMinutesToScheduleAheadFor();
            $minutesToScheduleAheadForDateTimeInterval = new \DateInterval('PT' . $minutesToScheduleAheadFor . 'M');
            $referenceDateTime = $this->_getReferenceDateTime();
            $referenceDistanceDateTime = $referenceDateTime->add($minutesToScheduleAheadForDateTimeInterval);

            $this->_create(self::PROP_REFERENCE_DISTANCE_DATE_TIME, $referenceDistanceDateTime);
        }

        return $this->_read(self::PROP_REFERENCE_DISTANCE_DATE_TIME);
    }

    protected function _getReferenceDateTime(): \DateTime
    {
        if (!$this->_exists(self::PROP_REFERENCE_DATE_TIME)) {
            $this->_create(self::PROP_REFERENCE_DATE_TIME, $this->_getTime()->getNow());
        }

        return $this->_read(self::PROP_REFERENCE_DATE_TIME);
    }

    protected function _getNextReferenceMinuteDateTime(): \DateTime
    {

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