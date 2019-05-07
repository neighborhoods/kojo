<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Environment\Memory;

use Neighborhoods\Kojo\Environment\MemoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoEnvironmentMemory;

    public function setEnvironmentMemory(MemoryInterface $environmentMemory): self
    {
        assert(!$this->hasEnvironmentMemory(),
            new \LogicException('NeighborhoodsKojoEnvironmentMemory is already set.'));
        $this->NeighborhoodsKojoEnvironmentMemory = $environmentMemory;

        return $this;
    }

    protected function getEnvironmentMemory(): MemoryInterface
    {
        assert($this->hasEnvironmentMemory(), new \LogicException('NeighborhoodsKojoEnvironmentMemory is not set.'));

        return $this->NeighborhoodsKojoEnvironmentMemory;
    }

    protected function hasEnvironmentMemory(): bool
    {
        return isset($this->NeighborhoodsKojoEnvironmentMemory);
    }

    protected function unsetEnvironmentMemory(): self
    {
        assert($this->hasEnvironmentMemory(), new \LogicException('NeighborhoodsKojoEnvironmentMemory is not set.'));
        unset($this->NeighborhoodsKojoEnvironmentMemory);

        return $this;
    }
}
