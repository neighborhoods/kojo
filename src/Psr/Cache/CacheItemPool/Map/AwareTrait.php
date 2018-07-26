<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool\Map;

use Neighborhoods\Kojo\Psr\Cache\CacheItemPool\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoPsrCacheCacheItemPoolMap;

    public function setPsrCacheCacheItemPoolMap(MapInterface $psrCacheCacheItemPoolMap): self
    {
        if ($this->hasPsrCacheCacheItemPoolMap()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolMap is already set.');
        }
        $this->NeighborhoodsKojoPsrCacheCacheItemPoolMap = $psrCacheCacheItemPoolMap;

        return $this;
    }

    protected function getPsrCacheCacheItemPoolMap(): MapInterface
    {
        if (!$this->hasPsrCacheCacheItemPoolMap()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolMap is not set.');
        }

        return $this->NeighborhoodsKojoPsrCacheCacheItemPoolMap;
    }

    protected function hasPsrCacheCacheItemPoolMap(): bool
    {
        return isset($this->NeighborhoodsKojoPsrCacheCacheItemPoolMap);
    }

    protected function unsetPsrCacheCacheItemPoolMap(): self
    {
        if (!$this->hasPsrCacheCacheItemPoolMap()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolMap is not set.');
        }
        unset($this->NeighborhoodsKojoPsrCacheCacheItemPoolMap);

        return $this;
    }
}
