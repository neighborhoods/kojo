<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler\Cache;

use Neighborhoods\Kojo\Scheduler\CacheInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSchedulerCache;

    public function setSchedulerCache(CacheInterface $schedulerCache): self
    {
        if ($this->hasSchedulerCache()) {
            throw new \LogicException('NeighborhoodsKojoSchedulerCache is already set.');
        }
        $this->NeighborhoodsKojoSchedulerCache = $schedulerCache;

        return $this;
    }

    protected function getSchedulerCache(): CacheInterface
    {
        if (!$this->hasSchedulerCache()) {
            throw new \LogicException('NeighborhoodsKojoSchedulerCache is not set.');
        }

        return $this->NeighborhoodsKojoSchedulerCache;
    }

    protected function hasSchedulerCache(): bool
    {
        return isset($this->NeighborhoodsKojoSchedulerCache);
    }

    protected function unsetSchedulerCache(): self
    {
        if (!$this->hasSchedulerCache()) {
            throw new \LogicException('NeighborhoodsKojoSchedulerCache is not set.');
        }
        unset($this->NeighborhoodsKojoSchedulerCache);

        return $this;
    }
}
