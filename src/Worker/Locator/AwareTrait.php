<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo\Worker\LocatorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoWorkerLocator;

    public function setWorkerLocator(LocatorInterface $workerLocator): self
    {
        if ($this->hasWorkerLocator()) {
            throw new \LogicException('NeighborhoodsKojoWorkerLocator is already set.');
        }
        $this->NeighborhoodsKojoWorkerLocator = $workerLocator;

        return $this;
    }

    protected function getWorkerLocator(): LocatorInterface
    {
        if (!$this->hasWorkerLocator()) {
            throw new \LogicException('NeighborhoodsKojoWorkerLocator is not set.');
        }

        return $this->NeighborhoodsKojoWorkerLocator;
    }

    protected function hasWorkerLocator(): bool
    {
        return isset($this->NeighborhoodsKojoWorkerLocator);
    }

    protected function unsetWorkerLocator(): self
    {
        if (!$this->hasWorkerLocator()) {
            throw new \LogicException('NeighborhoodsKojoWorkerLocator is not set.');
        }
        unset($this->NeighborhoodsKojoWorkerLocator);

        return $this;
    }
}
