<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work\Factory;

use Neighborhoods\Kojo\Service\Update\Work\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateWorkFactory;

    public function setServiceUpdateWorkFactory(FactoryInterface $serviceUpdateWorkFactory): self
    {
        if ($this->hasServiceUpdateWorkFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWorkFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateWorkFactory = $serviceUpdateWorkFactory;

        return $this;
    }

    protected function getServiceUpdateWorkFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateWorkFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWorkFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateWorkFactory;
    }

    protected function hasServiceUpdateWorkFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateWorkFactory);
    }

    protected function unsetServiceUpdateWorkFactory(): self
    {
        if (!$this->hasServiceUpdateWorkFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWorkFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateWorkFactory);

        return $this;
    }
}
