<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

interface CacheInterface
{
    const DATE_TIME_FORMAT_MYSQL_MINUTE    = 'Y-m-d H:i:00';
    const CACHE_SCHEDULED_AHEAD_VALUE      = 'scheduled';
    const CACHE_SCHEDULED_AHEAD_KEY_PREFIX = 'schedule_';
    const DATE_TIME_FORMAT_CACHE_MINUTE    = 'Y_m_d_H_i';
    public const CACHE_ITEM_POOL_ID        = 'scheduler';

    public function getMinutesNotInCache(): array;

    public function cacheScheduledMinutes(\DateTime $scheduledMinute): CacheInterface;
}