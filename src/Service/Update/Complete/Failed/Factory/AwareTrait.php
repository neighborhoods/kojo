<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed\Factory;

use Neighborhoods\Kojo\Service\Update\Complete\Failed\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCompleteFailedFactory;

    public function setServiceUpdateCompleteFailedFactory(FactoryInterface $serviceUpdateCompleteFailedFactory): self
    {
        if ($this->hasServiceUpdateCompleteFailedFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCompleteFailedFactory = $serviceUpdateCompleteFailedFactory;

        return $this;
    }

    protected function getServiceUpdateCompleteFailedFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateCompleteFailedFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCompleteFailedFactory;
    }

    protected function hasServiceUpdateCompleteFailedFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCompleteFailedFactory);
    }

    protected function unsetServiceUpdateCompleteFailedFactory(): self
    {
        if (!$this->hasServiceUpdateCompleteFailedFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCompleteFailedFactory);

        return $this;
    }
}
