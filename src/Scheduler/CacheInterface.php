<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

use Neighborhoods\Kojo\CacheItemPool\RepositoryInterface;

interface CacheInterface
{
    const DATE_TIME_FORMAT_MYSQL_MINUTE    = 'Y-m-d H:i:0';
    const CACHE_SCHEDULED_AHEAD_VALUE      = 'scheduled';
    const CACHE_SCHEDULED_AHEAD_KEY_PREFIX = 'schedule_';
    const DATE_TIME_FORMAT_CACHE_MINUTE    = 'Y_m_d_H_i';
    const PROP_SCHEDULED_KEY_LIFETIME      = 'scheduled_key_lifetime';
    public const CACHE_ITEM_POOL_ID        = 'scheduler';

    public function setCacheItemPoolRepository(RepositoryInterface $repository);

    public function getMinutesNotInCache(): array;

    public function cacheScheduledMinutes(\DateTime $scheduledMinute): CacheInterface;
}