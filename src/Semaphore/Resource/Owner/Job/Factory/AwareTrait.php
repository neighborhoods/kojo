<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner\Job\Factory;

use Neighborhoods\Kojo\Semaphore\Resource\Owner\Job\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResourceOwnerJobFactory;

    public function setSemaphoreResourceOwnerJobFactory(FactoryInterface $semaphoreResourceOwnerJobFactory): self
    {
        if ($this->hasSemaphoreResourceOwnerJobFactory()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwnerJobFactory is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResourceOwnerJobFactory = $semaphoreResourceOwnerJobFactory;

        return $this;
    }

    protected function getSemaphoreResourceOwnerJobFactory(): FactoryInterface
    {
        if (!$this->hasSemaphoreResourceOwnerJobFactory()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwnerJobFactory is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResourceOwnerJobFactory;
    }

    protected function hasSemaphoreResourceOwnerJobFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResourceOwnerJobFactory);
    }

    protected function unsetSemaphoreResourceOwnerJobFactory(): self
    {
        if (!$this->hasSemaphoreResourceOwnerJobFactory()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwnerJobFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResourceOwnerJobFactory);

        return $this;
    }
}
