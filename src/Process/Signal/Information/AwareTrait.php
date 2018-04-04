<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information;

use Neighborhoods\Kojo\Process\Signal\InformationInterface;

trait AwareTrait
{
    public function setProcessSignalInformation(InformationInterface $processSignalInformation): self
    {
        $this->_create(InformationInterface::class, $processSignalInformation);

        return $this;
    }

    protected function _getProcessSignalInformation(): InformationInterface
    {
        return $this->_read(InformationInterface::class);
    }

    protected function _getProcessSignalInformationClone(): InformationInterface
    {
        return clone $this->_getProcessSignalInformation();
    }

    protected function _hasProcessSignalInformation(): bool
    {
        return $this->_exists(InformationInterface::class);
    }

    protected function _unsetProcessSignalInformation(): self
    {
        $this->_delete(InformationInterface::class);

        return $this;
    }
}