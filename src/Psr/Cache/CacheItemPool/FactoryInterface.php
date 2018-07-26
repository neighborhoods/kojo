<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): CacheItemPoolInterface;
}
