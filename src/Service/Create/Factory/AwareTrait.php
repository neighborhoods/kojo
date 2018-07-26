<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create\Factory;

use Neighborhoods\Kojo\Service\Create\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceCreateFactory;

    public function setServiceCreateFactory(FactoryInterface $serviceCreateFactory): self
    {
        if ($this->hasServiceCreateFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreateFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceCreateFactory = $serviceCreateFactory;

        return $this;
    }

    protected function getServiceCreateFactory(): FactoryInterface
    {
        if (!$this->hasServiceCreateFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreateFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceCreateFactory;
    }

    protected function hasServiceCreateFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceCreateFactory);
    }

    protected function unsetServiceCreateFactory(): self
    {
        if (!$this->hasServiceCreateFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreateFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceCreateFactory);

        return $this;
    }
}
