<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool\Factory;

use Neighborhoods\Kojo\Psr\Cache\CacheItemPool\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoPsrCacheCacheItemPoolFactory;

    public function setPsrCacheCacheItemPoolFactory(FactoryInterface $psrCacheCacheItemPoolFactory): self
    {
        if ($this->hasPsrCacheCacheItemPoolFactory()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolFactory is already set.');
        }
        $this->NeighborhoodsKojoPsrCacheCacheItemPoolFactory = $psrCacheCacheItemPoolFactory;

        return $this;
    }

    protected function getPsrCacheCacheItemPoolFactory(): FactoryInterface
    {
        if (!$this->hasPsrCacheCacheItemPoolFactory()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolFactory is not set.');
        }

        return $this->NeighborhoodsKojoPsrCacheCacheItemPoolFactory;
    }

    protected function hasPsrCacheCacheItemPoolFactory(): bool
    {
        return isset($this->NeighborhoodsKojoPsrCacheCacheItemPoolFactory);
    }

    protected function unsetPsrCacheCacheItemPoolFactory(): self
    {
        if (!$this->hasPsrCacheCacheItemPoolFactory()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolFactory is not set.');
        }
        unset($this->NeighborhoodsKojoPsrCacheCacheItemPoolFactory);

        return $this;
    }
}
