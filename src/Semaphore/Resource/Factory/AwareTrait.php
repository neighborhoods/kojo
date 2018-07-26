<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Factory;

use Neighborhoods\Kojo\Semaphore\Resource\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResourceFactory;

    public function setSemaphoreResourceFactory(FactoryInterface $semaphoreResourceFactory): self
    {
        if ($this->hasSemaphoreResourceFactory()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceFactory is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResourceFactory = $semaphoreResourceFactory;

        return $this;
    }

    protected function getSemaphoreResourceFactory(): FactoryInterface
    {
        if (!$this->hasSemaphoreResourceFactory()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceFactory is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResourceFactory;
    }

    protected function hasSemaphoreResourceFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResourceFactory);
    }

    protected function unsetSemaphoreResourceFactory(): self
    {
        if (!$this->hasSemaphoreResourceFactory()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResourceFactory);

        return $this;
    }
}
