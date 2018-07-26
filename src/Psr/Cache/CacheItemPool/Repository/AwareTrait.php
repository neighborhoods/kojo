<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool\Repository;

use Neighborhoods\Kojo\Psr\Cache\CacheItemPool\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoPsrCacheCacheItemPoolRepository;

    public function setPsrCacheCacheItemPoolRepository(RepositoryInterface $psrCacheCacheItemPoolRepository): self
    {
        if ($this->hasPsrCacheCacheItemPoolRepository()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolRepository is already set.');
        }
        $this->NeighborhoodsKojoPsrCacheCacheItemPoolRepository = $psrCacheCacheItemPoolRepository;

        return $this;
    }

    protected function getPsrCacheCacheItemPoolRepository(): RepositoryInterface
    {
        if (!$this->hasPsrCacheCacheItemPoolRepository()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolRepository is not set.');
        }

        return $this->NeighborhoodsKojoPsrCacheCacheItemPoolRepository;
    }

    protected function hasPsrCacheCacheItemPoolRepository(): bool
    {
        return isset($this->NeighborhoodsKojoPsrCacheCacheItemPoolRepository);
    }

    protected function unsetPsrCacheCacheItemPoolRepository(): self
    {
        if (!$this->hasPsrCacheCacheItemPoolRepository()) {
            throw new \LogicException('NeighborhoodsKojoPsrCacheCacheItemPoolRepository is not set.');
        }
        unset($this->NeighborhoodsKojoPsrCacheCacheItemPoolRepository);

        return $this;
    }
}
