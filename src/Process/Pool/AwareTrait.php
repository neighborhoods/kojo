<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPool;

    public function setProcessPool(PoolInterface $processPool): self
    {
        if ($this->hasProcessPool()) {
            throw new \LogicException('NeighborhoodsKojoProcessPool is already set.');
        }
        $this->NeighborhoodsKojoProcessPool = $processPool;

        return $this;
    }

    protected function getProcessPool(): PoolInterface
    {
        if (!$this->hasProcessPool()) {
            throw new \LogicException('NeighborhoodsKojoProcessPool is not set.');
        }

        return $this->NeighborhoodsKojoProcessPool;
    }

    protected function hasProcessPool(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPool);
    }

    protected function unsetProcessPool(): self
    {
        if (!$this->hasProcessPool()) {
            throw new \LogicException('NeighborhoodsKojoProcessPool is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPool);

        return $this;
    }
}
