<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information\Factory;

use Neighborhoods\Kojo\Process\Signal\Information\FactoryInterface;

trait AwareTrait
{
    public function setProcessSignalInformationFactory(FactoryInterface $processSignalInformationFactory): self
    {
        $this->_create(FactoryInterface::class, $processSignalInformationFactory);

        return $this;
    }

    protected function _getProcessSignalInformationFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getProcessSignalInformationFactoryClone(): FactoryInterface
    {
        return clone $this->_getProcessSignalInformationFactory();
    }

    protected function _hasProcessSignalInformationFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetProcessSignalInformationFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}