<?php
declare(strict_types=1);

namespace NHDS\Jobs\Scheduler;

use Psr\Cache\CacheItemPoolInterface;

interface CacheInterface
{
    const DATE_TIME_FORMAT_MYSQL_MINUTE    = 'Y-m-d H:i:0';
    const CACHE_SCHEDULED_AHEAD_VALUE      = 'scheduled';
    const CACHE_SCHEDULED_AHEAD_KEY_PREFIX = 'schedule_';
    const DATE_TIME_FORMAT_CACHE_MINUTE    = 'Y_m_d_H_i';
    const PROP_SCHEDULED_KEY_LIFETIME      = 'scheduled_key_lifetime';

    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool);

    public function getScheduledMinutesNotInCache();

    public function isMinuteScheduledInCache(\DateTime $referenceMinuteDateTime): bool;

    public function getScheduledKeyLifetime(): \DateTime;

    public function cacheScheduledMinutes(\DateTime $scheduledMinute): CacheInterface;

    public function getMinutesNotInCache(): array;
}