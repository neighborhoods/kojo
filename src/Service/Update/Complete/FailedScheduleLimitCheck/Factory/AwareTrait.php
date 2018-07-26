<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck\Factory;

use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory;

    public function setServiceUpdateCompleteFailedScheduleLimitCheckFactory(
        FactoryInterface $serviceUpdateCompleteFailedScheduleLimitCheckFactory
    ): self {
        if ($this->hasServiceUpdateCompleteFailedScheduleLimitCheckFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory = $serviceUpdateCompleteFailedScheduleLimitCheckFactory;

        return $this;
    }

    protected function getServiceUpdateCompleteFailedScheduleLimitCheckFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateCompleteFailedScheduleLimitCheckFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory;
    }

    protected function hasServiceUpdateCompleteFailedScheduleLimitCheckFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory);
    }

    protected function unsetServiceUpdateCompleteFailedScheduleLimitCheckFactory(): self
    {
        if (!$this->hasServiceUpdateCompleteFailedScheduleLimitCheckFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheckFactory);

        return $this;
    }
}
