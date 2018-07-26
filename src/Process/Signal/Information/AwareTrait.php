<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information;

use Neighborhoods\Kojo\Process\Signal\InformationInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignalInformation;

    public function setProcessSignalInformation(InformationInterface $processSignalInformation): self
    {
        if ($this->hasProcessSignalInformation()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignalInformation is already set.');
        }
        $this->NeighborhoodsKojoProcessSignalInformation = $processSignalInformation;

        return $this;
    }

    protected function getProcessSignalInformation(): InformationInterface
    {
        if (!$this->hasProcessSignalInformation()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignalInformation is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignalInformation;
    }

    protected function hasProcessSignalInformation(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignalInformation);
    }

    protected function unsetProcessSignalInformation(): self
    {
        if (!$this->hasProcessSignalInformation()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignalInformation is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignalInformation);

        return $this;
    }
}
