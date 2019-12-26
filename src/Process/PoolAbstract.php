<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use LogicException;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

abstract class PoolAbstract implements PoolInterface
{
    use Defensive\AwareTrait;
    use Process\Pool\Logger\AwareTrait;
    use Process\Pool\Strategy\AwareTrait;
    use Process\AwareTrait;
    use Process\Signal\Dispatcher\AwareTrait;

    const PROP_RECEIVED_SIG_QUIT = 'received_sig_quit';

    public function hasReceivedSigQuit() : bool
    {
        if ($this->_hasReceivedSigQuit === null) {
            throw new \LogicException('PoolAbstract _hasReceivedSigQuit has not been set.');
        }

        return $this->_hasReceivedSigQuit;
    }

    public function setHasReceivedSigQuit(bool $hasReceivedSigQuit) : PoolInterface
    {
        if ($this->_hasReceivedSigQuit !== false) {
            throw new \LogicException('PoolAbstract _hasReceivedSigQuit is already set.');
        }

        $this->_hasReceivedSigQuit = $hasReceivedSigQuit;

        return $this;
    }

    abstract protected function _childExitSignal(InformationInterface $information): PoolInterface;

    public function hasAlarm(): bool
    {
        $hasAlarm = false;
        if (($seconds = pcntl_alarm(0)) > 0) {
            $hasAlarm = true;
        }
        pcntl_alarm($seconds);

        return $hasAlarm;
    }

    public function setAlarm(int $seconds): PoolInterface
    {
        if ($seconds === 0) {
            $this->_getLogger()->debug('Disabling any existing alarm.');
        } else {
            $this->_getLogger()->debug(sprintf('Setting alarm for [%s] seconds.', $seconds));
        }
        pcntl_alarm($seconds);

        return $this;
    }

    public function isEmpty(): bool
    {
        return ($this->getCountOfChildProcesses() === 0);
    }

    public function isFull(): bool
    {
        return ($this->getCountOfChildProcesses() >= $this->_getProcessPoolStrategy()->getMaxChildProcesses());
    }

    public function canEnvironmentSustainAdditionProcesses(): bool
    {
        $currentLoadAverage = (float)current(sys_getloadavg());
        $maximumLoadAverage = $this->_getProcessPoolStrategy()->getMaximumLoadAverage();
        $canEnvironmentSustainAdditionProcesses = $currentLoadAverage <= $maximumLoadAverage;

        if (!$canEnvironmentSustainAdditionProcesses) {
            $this->_getLogger()->warning(
                'Kōjō Process Pool is constrained by load average',
                [
                    'current_load_average' => $currentLoadAverage,
                    'maximum_load_average' => $maximumLoadAverage,
                ]
            );
        }

        return $canEnvironmentSustainAdditionProcesses;
    }

    protected function _initialize(): PoolInterface
    {
        $this->_getProcessPoolStrategy()->initializePool();

        return $this;
    }

    protected function _alarmSignal(/** @noinspection PhpUnusedParameterInspection */ InformationInterface $information
    ): PoolInterface {
        $this->_getProcessPoolStrategy()->receivedAlarm();

        return $this;
    }

    protected function _validateAlarm(): PoolInterface
    {
        $alarmValue = pcntl_alarm(0);
        if ($this->isEmpty()) {
            if ($alarmValue === 0) {
                $this->_getLogger()->emergency('Process pool has no alarms and no processes.');
                throw new LogicException('Invalid process pool state.');
            }

            $this->_getLogger()->debug('Process pool only has a set alarm.');
        }
        pcntl_alarm($alarmValue);

        return $this;
    }

    public function getProcess(): ProcessInterface
    {
        return $this->_getProcess();
    }
}
