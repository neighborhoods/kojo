<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic\Factory;

use Neighborhoods\Kojo\Service\Update\Panic\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdatePanicFactory;

    public function setServiceUpdatePanicFactory(FactoryInterface $serviceUpdatePanicFactory): self
    {
        if ($this->hasServiceUpdatePanicFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdatePanicFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdatePanicFactory = $serviceUpdatePanicFactory;

        return $this;
    }

    protected function getServiceUpdatePanicFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdatePanicFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdatePanicFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdatePanicFactory;
    }

    protected function hasServiceUpdatePanicFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdatePanicFactory);
    }

    protected function unsetServiceUpdatePanicFactory(): self
    {
        if (!$this->hasServiceUpdatePanicFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdatePanicFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdatePanicFactory);

        return $this;
    }
}
