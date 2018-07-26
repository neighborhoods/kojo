<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;

use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheckInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck;

    public function setServiceUpdateCompleteFailedScheduleLimitCheck(
        FailedScheduleLimitCheckInterface $serviceUpdateCompleteFailedScheduleLimitCheck
    ): self {
        if ($this->hasServiceUpdateCompleteFailedScheduleLimitCheck()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck = $serviceUpdateCompleteFailedScheduleLimitCheck;

        return $this;
    }

    protected function getServiceUpdateCompleteFailedScheduleLimitCheck(): FailedScheduleLimitCheckInterface
    {
        if (!$this->hasServiceUpdateCompleteFailedScheduleLimitCheck()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck;
    }

    protected function hasServiceUpdateCompleteFailedScheduleLimitCheck(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck);
    }

    protected function unsetServiceUpdateCompleteFailedScheduleLimitCheck(): self
    {
        if (!$this->hasServiceUpdateCompleteFailedScheduleLimitCheck()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCompleteFailedScheduleLimitCheck);

        return $this;
    }
}
