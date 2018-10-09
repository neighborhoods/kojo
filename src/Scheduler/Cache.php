<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Pylon\Time;
use Neighborhoods\Kojo\CacheItemPool;

class Cache implements CacheInterface
{
    use Defensive\AwareTrait;
    use Scheduler\Time\AwareTrait;
    use Time\AwareTrait;
    use CacheItemPool\Repository\AwareTrait;
    protected $_scheduleMinutesNotInCache = [];
    /** @var string */
    protected $cacheScheduledAheadKeyPrefix;

    public function getMinutesNotInCache(): array
    {
        if (empty($this->_scheduleMinutesNotInCache)) {
            $nexReferenceMinuteDateTime = $this->_getSchedulerTime()->getNextReferenceMinuteDateTime();
            while ($this->_getSchedulerTime()->getReferenceDistanceDateTime() >= $nexReferenceMinuteDateTime) {
                if (!$this->_isMinuteScheduledInCache($nexReferenceMinuteDateTime)) {
                    $scheduleMinute = $nexReferenceMinuteDateTime;
                    $scheduleMinuteIndex = $scheduleMinute->format(self::DATE_TIME_FORMAT_MYSQL_MINUTE);
                    $this->_scheduleMinutesNotInCache[$scheduleMinuteIndex] = $scheduleMinute;
                }
                $nexReferenceMinuteDateTime = $this->_getSchedulerTime()->getNextReferenceMinuteDateTime();
            }
        }

        return $this->_scheduleMinutesNotInCache;
    }

    protected function _isMinuteScheduledInCache(\DateTime $referenceMinuteDateTime): bool
    {
        $isMinuteScheduled = false;
        $referenceMinuteDateTimeString = $referenceMinuteDateTime->format(self::DATE_TIME_FORMAT_CACHE_MINUTE);
        $cacheItemPool = $this->_getCacheItemPoolRepository()->getById(self::CACHE_ITEM_POOL_ID);
        $hasItem = $cacheItemPool->hasItem($this->getCacheScheduledAheadKeyPrefix() . $referenceMinuteDateTimeString);
        if ($hasItem) {
            $isMinuteScheduled = true;
        }

        return $isMinuteScheduled;
    }

    protected function _getScheduledKeyLifetime(): \DateTime
    {
        if (!$this->_exists(self::PROP_SCHEDULED_KEY_LIFETIME)) {
            $now = $this->_getTime()->getNow();
            $lifetimeSeconds = 5 * 60 + $this->_getSchedulerTime()->getMinutesToScheduleAheadFor();
            $dateInterval = new \DateInterval('PT' . $lifetimeSeconds . 'S');
            $this->_create(self::PROP_SCHEDULED_KEY_LIFETIME, $now->add($dateInterval));
        }

        return $this->_read(self::PROP_SCHEDULED_KEY_LIFETIME);
    }

    public function cacheScheduledMinutes(\DateTime $scheduledMinute): CacheInterface
    {
        $cacheItemPool = $this->_getCacheItemPoolRepository()->getById(self::CACHE_ITEM_POOL_ID);
        $cachedMinuteDateTimeString = $scheduledMinute->format(self::DATE_TIME_FORMAT_CACHE_MINUTE);
        $cacheItem = $cacheItemPool->getItem($this->getCacheScheduledAheadKeyPrefix() . $cachedMinuteDateTimeString);
        $cacheItem->set(self::CACHE_SCHEDULED_AHEAD_VALUE);
        $cacheItem->expiresAt($this->_getScheduledKeyLifetime());
        $cacheItemPool->save($cacheItem);

        return $this;
    }

    public function getCacheScheduledAheadKeyPrefix() : string
    {
        if ($this->cacheScheduledAheadKeyPrefix === null) {
            return self::CACHE_SCHEDULED_AHEAD_KEY_PREFIX;
        }

        return $this->cacheScheduledAheadKeyPrefix;
    }

    public function setCacheScheduledAheadKeyPrefix(string $cacheScheduledAheadKeyPrefix) : CacheInterface
    {
        if ($this->cacheScheduledAheadKeyPrefix !== null) {
            throw new \LogicException('Cache cacheScheduledAheadKeyPrefix is already set.');
        }

        $this->cacheScheduledAheadKeyPrefix = $cacheScheduledAheadKeyPrefix;

        return $this;
    }
}
