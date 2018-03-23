<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Signal;

use NHDS\Jobs\Process\SignalInterface;

trait AwareTrait
{
    public function setProcessSignal(SignalInterface $processSignal): self
    {
        $this->_create(SignalInterface::class, $processSignal);

        return $this;
    }

    protected function _getProcessSignal(): SignalInterface
    {
        return $this->_read(SignalInterface::class);
    }

    protected function _getProcessSignalClone(): SignalInterface
    {
        return clone $this->_getProcessSignal();
    }

    protected function _hasProcessSignal(): bool
    {
        return $this->_exists(SignalInterface::class);
    }

    protected function _unsetProcessSignal(): self
    {
        $this->_delete(SignalInterface::class);

        return $this;
    }
}