<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information\Factory;

use Neighborhoods\Kojo\Process\Signal\Information\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignalInformationFactory;

    public function setProcessSignalInformationFactory(FactoryInterface $processSignalInformationFactory): self
    {
        if ($this->hasProcessSignalInformationFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignalInformationFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessSignalInformationFactory = $processSignalInformationFactory;

        return $this;
    }

    protected function getProcessSignalInformationFactory(): FactoryInterface
    {
        if (!$this->hasProcessSignalInformationFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignalInformationFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignalInformationFactory;
    }

    protected function hasProcessSignalInformationFactory(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignalInformationFactory);
    }

    protected function unsetProcessSignalInformationFactory(): self
    {
        if (!$this->hasProcessSignalInformationFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessSignalInformationFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignalInformationFactory);

        return $this;
    }
}
