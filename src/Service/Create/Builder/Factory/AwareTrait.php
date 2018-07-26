<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create\Builder\Factory;

use Neighborhoods\Kojo\Service\Create\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceCreateBuilderFactory;

    public function setServiceCreateBuilderFactory(FactoryInterface $serviceCreateBuilderFactory): self
    {
        if ($this->hasServiceCreateBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreateBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceCreateBuilderFactory = $serviceCreateBuilderFactory;

        return $this;
    }

    protected function getServiceCreateBuilderFactory(): FactoryInterface
    {
        if (!$this->hasServiceCreateBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreateBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceCreateBuilderFactory;
    }

    protected function hasServiceCreateBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceCreateBuilderFactory);
    }

    protected function unsetServiceCreateBuilderFactory(): self
    {
        if (!$this->hasServiceCreateBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreateBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceCreateBuilderFactory);

        return $this;
    }
}
