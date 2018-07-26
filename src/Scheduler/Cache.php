<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

use Neighborhoods\Kojo\Time;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Kojo\Psr;

class Cache implements CacheInterface
{
    use Scheduler\Time\AwareTrait;
    use Time\AwareTrait;
    use Psr\Cache\CacheItemPool\Repository\AwareTrait;
    protected $scheduleMinutesNotInCache = [];
    protected $scheduledKeyLifetime;

    public function getMinutesNotInCache(): array
    {
        if (empty($this->scheduleMinutesNotInCache)) {
            $nexReferenceMinuteDateTime = $this->getSchedulerTime()->getNextReferenceMinuteDateTime();
            while ($this->getSchedulerTime()->getReferenceDistanceDateTime() >= $nexReferenceMinuteDateTime) {
                if (!$this->isMinuteScheduledInCache($nexReferenceMinuteDateTime)) {
                    $scheduleMinute = $nexReferenceMinuteDateTime;
                    $scheduleMinuteIndex = $scheduleMinute->format(self::DATE_TIME_FORMAT_MYSQL_MINUTE);
                    $this->scheduleMinutesNotInCache[$scheduleMinuteIndex] = $scheduleMinute;
                }
                $nexReferenceMinuteDateTime = $this->getSchedulerTime()->getNextReferenceMinuteDateTime();
            }
        }

        return $this->scheduleMinutesNotInCache;
    }

    protected function isMinuteScheduledInCache(\DateTime $referenceMinuteDateTime): bool
    {
        $isMinuteScheduled = false;
        $referenceMinuteDateTimeString = $referenceMinuteDateTime->format(self::DATE_TIME_FORMAT_CACHE_MINUTE);
        $cacheItemPool = $this->getPsrCacheCacheItemPoolRepository()->get(self::CACHE_ITEM_POOL_ID);
        $hasItem = $cacheItemPool->hasItem(self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX . $referenceMinuteDateTimeString);
        if ($hasItem) {
            $isMinuteScheduled = true;
        }

        return $isMinuteScheduled;
    }

    protected function getScheduledKeyLifetime(): \DateTime
    {
        if ($this->scheduledKeyLifetime === null) {
            $now = $this->getTime()->getNow();
            $lifetimeSeconds = 5 * 60 + $this->getSchedulerTime()->getMinutesToScheduleAheadFor();
            $dateInterval = new \DateInterval('PT' . $lifetimeSeconds . 'S');
            $this->scheduledKeyLifetime = $now->add($dateInterval);
        }

        return $this->scheduledKeyLifetime;
    }

    public function cacheScheduledMinutes(\DateTime $scheduledMinute): CacheInterface
    {
        $cacheItemPool = $this->getPsrCacheCacheItemPoolRepository()->get(self::CACHE_ITEM_POOL_ID);
        $cachedMinuteDateTimeString = $scheduledMinute->format(self::DATE_TIME_FORMAT_CACHE_MINUTE);
        $cacheItem = $cacheItemPool->getItem(self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX . $cachedMinuteDateTimeString);
        $cacheItem->set(self::CACHE_SCHEDULED_AHEAD_VALUE);
        $cacheItem->expiresAt($this->getScheduledKeyLifetime());
        $cacheItemPool->save($cacheItem);

        return $this;
    }
}