<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal;

use Neighborhoods\Kojo\Process\SignalInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignal;

    public function setProcessSignal(SignalInterface $processSignal): self
    {
        if ($this->hasProcessSignal()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignal is already set.');
        }
        $this->NeighborhoodsKojoProcessSignal = $processSignal;

        return $this;
    }

    protected function getProcessSignal(): SignalInterface
    {
        if (!$this->hasProcessSignal()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignal is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignal;
    }

    protected function hasProcessSignal(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignal);
    }

    protected function unsetProcessSignal(): self
    {
        if (!$this->hasProcessSignal()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignal is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignal);

        return $this;
    }
}
