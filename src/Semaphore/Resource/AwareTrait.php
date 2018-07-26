<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResource;

    public function setSemaphoreResource(ResourceInterface $semaphoreResource): self
    {
        if ($this->hasSemaphoreResource()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResource is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResource = $semaphoreResource;

        return $this;
    }

    protected function getSemaphoreResource(): ResourceInterface
    {
        if (!$this->hasSemaphoreResource()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResource is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResource;
    }

    protected function hasSemaphoreResource(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResource);
    }

    protected function unsetSemaphoreResource(): self
    {
        if (!$this->hasSemaphoreResource()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResource is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResource);

        return $this;
    }
}
