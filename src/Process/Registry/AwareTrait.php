<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Registry;

use Neighborhoods\Kojo\Process\RegistryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessRegistry;

    public function setProcessRegistry(RegistryInterface $processRegistry): self
    {
        if ($this->hasProcessRegistry()) {
            throw new \LogicException('NeighborhoodsKojoProcessRegistry is already set.');
        }
        $this->NeighborhoodsKojoProcessRegistry = $processRegistry;

        return $this;
    }

    protected function getProcessRegistry(): RegistryInterface
    {
        if (!$this->hasProcessRegistry()) {
            throw new \LogicException('NeighborhoodsKojoProcessRegistry is not set.');
        }

        return $this->NeighborhoodsKojoProcessRegistry;
    }

    protected function hasProcessRegistry(): bool
    {
        return isset($this->NeighborhoodsKojoProcessRegistry);
    }

    protected function unsetProcessRegistry(): self
    {
        if (!$this->hasProcessRegistry()) {
            throw new \LogicException('NeighborhoodsKojoProcessRegistry is not set.');
        }
        unset($this->NeighborhoodsKojoProcessRegistry);

        return $this;
    }
}
