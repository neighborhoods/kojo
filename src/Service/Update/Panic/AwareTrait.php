<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic;

use Neighborhoods\Kojo\Service\Update\PanicInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdatePanic;

    public function setServiceUpdatePanic(PanicInterface $serviceUpdatePanic): self
    {
        if ($this->hasServiceUpdatePanic()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdatePanic is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdatePanic = $serviceUpdatePanic;

        return $this;
    }

    protected function getServiceUpdatePanic(): PanicInterface
    {
        if (!$this->hasServiceUpdatePanic()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdatePanic is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdatePanic;
    }

    protected function hasServiceUpdatePanic(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdatePanic);
    }

    protected function unsetServiceUpdatePanic(): self
    {
        if (!$this->hasServiceUpdatePanic()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdatePanic is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdatePanic);

        return $this;
    }
}
