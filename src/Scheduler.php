<?php

namespace NHDS\Jobs;

use Psr\Cache\CacheItemPoolInterface;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Scheduler\ScheduleInterface;
use NHDS\Jobs\Data\Property\Crud;
use NHDS\Jobs\Db;

class Scheduler implements SchedulerInterface
{
    use Db\Connection\Container\AwareTrait;
    use Time\AwareTrait;
    use Crud\AwareTrait;
    const CACHE_SCHEDULED_AHEAD_VALUE      = 'scheduled';
    const CACHE_SCHEDULE_TAG_NAMESPACE     = 'nhds_jobs';
    const CACHE_SCHEDULED_AHEAD_KEY_PREFIX = 'schedule_';
    const PROP_SCHEDULE                    = 'schedule';
    const PROP_CACHE_ADAPTER               = 'cache_adapter';
    const PROP_CACHE_ITEM_POOL             = 'cache_item_pool';
    const PROP_JOB_TYPES                   = 'job_types';
    const PROP_MINUTES_SCHEDULED_AHEAD_FOR = 'minutes_scheduled_ahead_for';
    const PROP_SCHEDULED_KEY_LIFETIME      = 'scheduled_key_lifetime';
    protected $_scheduledKeyLifetime;
    protected $_unscheduledMinutes = [];
    protected $_existingJobs;

    public function schedule(): SchedulerInterface
    {
        if (!empty($this->_getUnscheduledMinutes())) {
            $this->_getExistingJobs();
            $this->_generateJobs();
        }

        return $this;
    }

    protected function _getScheduleClone(): ScheduleInterface
    {
        return clone $this->_read(self::PROP_SCHEDULE);
    }

    public function setSchedule(ScheduleInterface $schedule): SchedulerInterface
    {
        $this->_create(self::PROP_SCHEDULE, $schedule);

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
        if ($this->_unscheduledMinutes === null) {
            $scheduleAheadFor = $this->_getMinutesScheduleAheadFor();
            $timeAhead = ((int)$this->_getTime()->getNow()->format('U')) + $scheduleAheadFor;
            for ($time = $this->_getTime()->getNow()->format('U'); $time < $timeAhead; $time += 60) {
                $minute = strftime('%Y-%m-%d %H:%M:00', $time);
                $test = strftime('%Y_%m_%d_%H_%M_00', $time);
                if ($this->_getCacheItemPool()->hasItem(self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX . $test)) {
                    continue;
                }else {
                    $this->_unscheduledMinutes[$minute] = $time;
                }
            }
        }

        return $this->_unscheduledMinutes;
    }

    protected function _generateJobs()
    {
        foreach ($this->_getJobTypes() as $jobType) {
            $this->_getScheduleClone()->setJobCode($jobType['code'])->setCronExpression($jobType['cron_expression']);

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
            $lifetimeSeconds = 5 * 60 + $this->_getMinutesScheduleAheadFor();
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

    public function setCacheItemPoolInterface(CacheItemPoolInterface $cacheItemPool): SchedulerInterface
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
        $scheduleAheadFor = $this->_getMinutesScheduleAheadFor();
        $now = $this->_getTime()->getNow();
        $dateInterval = new \DateInterval('PT' . $scheduleAheadFor . 'S');
        $now->sub($dateInterval);

        return $this;
    }

    protected function _getMinutesScheduleAheadFor(): int
    {
        if (!$this->_exists(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR)) {
            $this->_create(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR, 1);
        }

        return $this->_read(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR);
    }

    public function setMinutesScheduleAheadFor(int $minutesScheduledAheadFor): SchedulerInterface
    {
        $this->_create(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR, $minutesScheduledAheadFor);

        return $this;
    }
}