<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Hold;

use Neighborhoods\Kojo\Service\Update\HoldInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateHold;

    public function setServiceUpdateHold(HoldInterface $serviceUpdateHold): self
    {
        if ($this->hasServiceUpdateHold()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateHold is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateHold = $serviceUpdateHold;

        return $this;
    }

    protected function getServiceUpdateHold(): HoldInterface
    {
        if (!$this->hasServiceUpdateHold()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateHold is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateHold;
    }

    protected function hasServiceUpdateHold(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateHold);
    }

    protected function unsetServiceUpdateHold(): self
    {
        if (!$this->hasServiceUpdateHold()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateHold is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateHold);

        return $this;
    }
}
