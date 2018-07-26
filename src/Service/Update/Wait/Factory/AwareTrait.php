<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Wait\Factory;

use Neighborhoods\Kojo\Service\Update\Wait\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateWaitFactory;

    public function setServiceUpdateWaitFactory(FactoryInterface $serviceUpdateWaitFactory): self
    {
        if ($this->hasServiceUpdateWaitFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWaitFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateWaitFactory = $serviceUpdateWaitFactory;

        return $this;
    }

    protected function getServiceUpdateWaitFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateWaitFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWaitFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateWaitFactory;
    }

    protected function hasServiceUpdateWaitFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateWaitFactory);
    }

    protected function unsetServiceUpdateWaitFactory(): self
    {
        if (!$this->hasServiceUpdateWaitFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWaitFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateWaitFactory);

        return $this;
    }
}
