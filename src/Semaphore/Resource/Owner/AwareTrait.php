<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResourceOwner;

    public function setSemaphoreResourceOwner(OwnerInterface $semaphoreResourceOwner): self
    {
        if ($this->hasSemaphoreResourceOwner()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwner is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResourceOwner = $semaphoreResourceOwner;

        return $this;
    }

    protected function getSemaphoreResourceOwner(): OwnerInterface
    {
        if (!$this->hasSemaphoreResourceOwner()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwner is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResourceOwner;
    }

    protected function hasSemaphoreResourceOwner(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResourceOwner);
    }

    protected function unsetSemaphoreResourceOwner(): self
    {
        if (!$this->hasSemaphoreResourceOwner()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwner is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResourceOwner);

        return $this;
    }
}
