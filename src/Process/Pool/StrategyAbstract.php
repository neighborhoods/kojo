<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use LogicException;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Process\Collection;
use Neighborhoods\Kojo\Environment;

abstract class StrategyAbstract implements StrategyInterface
{
    use AwareTrait;
    use Defensive\AwareTrait;
    use Logger\AwareTrait;
    use Collection\AwareTrait;
    use Environment\Memory\AwareTrait;

    public function setMaxAlarmTime(int $seconds): StrategyInterface
    {
        $this->_create(self::PROP_MAX_ALARM_TIME, $seconds);

        return $this;
    }

    public function getMaxAlarmTime(): int
    {
        return $this->_read(self::PROP_MAX_ALARM_TIME);
    }

    public function setChildProcessWaitThrottle(int $seconds): StrategyInterface
    {
        $this->_create(self::PROP_CHILD_PROCESS_WAIT_THROTTLE, $seconds);

        return $this;
    }

    public function getChildProcessWaitThrottle(): int
    {
        return $this->_read(self::PROP_CHILD_PROCESS_WAIT_THROTTLE);
    }

    public function setMaxChildProcesses(int $maxChildProcesses): StrategyInterface
    {
        $this->_create(self::PROP_MAX_CHILD_PROCESSES, $maxChildProcesses);

        return $this;
    }

    public function getMaxChildProcesses(): int
    {
        return $this->_read(self::PROP_MAX_CHILD_PROCESSES);
    }

    public function setAlarmProcessTypeCode(string $alarmProcessTypeCode): StrategyInterface
    {
        $this->_create(self::PROP_ALARM_PROCESS_TYPE_CODE, $alarmProcessTypeCode);

        return $this;
    }

    public function canEnvironmentSustainAdditionalProcesses(): bool
    {
        $canEnvironmentSustainAdditionalProcesses = true;
        $maximumEnvironmentLoadAverage = $this->getMaximumLoadAverage();
        $currentEnvironmentLoadAverage = (float)current(sys_getloadavg());
        if ($currentEnvironmentLoadAverage <= $maximumEnvironmentLoadAverage) {
            $canEnvironmentSustainAdditionalProcesses = false;
            $this->_getLogger()->debug(sprintf(
                'Current environment load average of [%s] equals or exceeds maximum environment load average of [%s].',
                $currentEnvironmentLoadAverage,
                $maximumEnvironmentLoadAverage
            ));
        } else {
            $numberOfCurrentWorkers = $this->_getProcessPool()->getCountOfChildProcesses();
            $maximumNumberOfWorkers = $this->getEnvironmentMemory()->getMaximumNumberOfWorkers();
            if ($maximumNumberOfWorkers > $numberOfCurrentWorkers) {
                throw new LogicException(sprintf(
                    'Current number of workers [%s] exceeds the maximum number of workers [%s].',
                    $numberOfCurrentWorkers,
                    $maximumNumberOfWorkers
                ));
            }
            if ($maximumNumberOfWorkers === $numberOfCurrentWorkers) {
                $canEnvironmentSustainAdditionalProcesses = false;
                $this->_getLogger()->debug(sprintf(
                    'Current number of workers [%s] is equivalent to maximum number of workers [%s].',
                    $numberOfCurrentWorkers,
                    $maximumNumberOfWorkers
                ));
            }
        }

        return $canEnvironmentSustainAdditionalProcesses;
    }

    protected function _getAlarmProcessTypeCode(): string
    {
        return $this->_read(self::PROP_ALARM_PROCESS_TYPE_CODE);
    }

    public function setFillProcessTypeCode(string $fillProcessTypeCode): StrategyInterface
    {
        $this->_create(self::PROP_FILL_PROCESS_TYPE_CODE, $fillProcessTypeCode);

        return $this;
    }

    protected function _hasFillProcessTypeCode(): bool
    {
        return $this->_exists(self::PROP_FILL_PROCESS_TYPE_CODE);
    }

    protected function _getFillProcessTypeCode(): string
    {
        return $this->_read(self::PROP_FILL_PROCESS_TYPE_CODE);
    }

    public function setMaximumLoadAverage(float $maximumLoadAverage): StrategyInterface
    {
        $this->_create(self::PROP_MAXIMUM_LOAD_AVERAGE, $maximumLoadAverage);

        return $this;
    }

    public function getMaximumLoadAverage(): float
    {
        return $this->_read(self:: PROP_MAXIMUM_LOAD_AVERAGE);
    }
}
