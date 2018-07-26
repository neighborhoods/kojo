<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Hold\Factory;

use Neighborhoods\Kojo\Service\Update\Hold\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateHoldFactory;

    public function setServiceUpdateHoldFactory(FactoryInterface $serviceUpdateHoldFactory): self
    {
        if ($this->hasServiceUpdateHoldFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateHoldFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateHoldFactory = $serviceUpdateHoldFactory;

        return $this;
    }

    protected function getServiceUpdateHoldFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateHoldFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateHoldFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateHoldFactory;
    }

    protected function hasServiceUpdateHoldFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateHoldFactory);
    }

    protected function unsetServiceUpdateHoldFactory(): self
    {
        if (!$this->hasServiceUpdateHoldFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateHoldFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateHoldFactory);

        return $this;
    }
}
