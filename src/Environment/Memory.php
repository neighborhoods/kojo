<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Environment;

use InvalidArgumentException;
use LogicException;

class Memory implements MemoryInterface
{
    protected $EnvironmentMaximumMemoryValue;
    protected $EnvironmentMaximumMemoryInputUnit;
    protected $WorkerMaximumMemoryValue;
    protected $WorkerMaximumMemoryInputUnit;
    protected $MaximumNumberOfWorkers;

    public function getMaximumNumberOfWorkers(): int
    {
        if ($this->MaximumNumberOfWorkers === null) {
            $environmentMaximumMemoryValue = $this->getEnvironmentMaximumMemoryValue();
            $workerMaximumMemoryValue = $this->getWorkerMaximumMemoryValue();
            $maximumNumberOfWorkers = (int)floor($environmentMaximumMemoryValue / $workerMaximumMemoryValue);
            $this->MaximumNumberOfWorkers = $maximumNumberOfWorkers;
        }

        return $this->MaximumNumberOfWorkers;
    }

    public function setEnvironmentMaximumMemoryValue(int $EnvironmentMaximumMemoryValue): MemoryInterface
    {
        if ($this->EnvironmentMaximumMemoryValue !== null) {
            throw new LogicException('Environment Maximum Memory Value is already set.');
        }

        $this->EnvironmentMaximumMemoryValue = $this->getBytes(
            $EnvironmentMaximumMemoryValue,
            $this->getEnvironmentMaximumMemoryInputUnit()
        );

        return $this;
    }

    protected function getEnvironmentMaximumMemoryValue(): int
    {
        if ($this->EnvironmentMaximumMemoryValue === null) {
            throw new LogicException('Environment Maximum Memory Value has not been set.');
        }

        return $this->EnvironmentMaximumMemoryValue;
    }

    public function setEnvironmentMaximumMemoryInputUnit(string $EnvironmentMaximumMemoryUnit): MemoryInterface
    {
        if ($this->EnvironmentMaximumMemoryInputUnit !== null) {
            throw new LogicException('Environment Maximum Memory Input Unit is already set.');
        }

        $this->assertValidMemoryUnit($EnvironmentMaximumMemoryUnit);
        $this->EnvironmentMaximumMemoryInputUnit = $EnvironmentMaximumMemoryUnit;

        return $this;
    }

    protected function getEnvironmentMaximumMemoryInputUnit(): string
    {
        if ($this->EnvironmentMaximumMemoryInputUnit === null) {
            throw new LogicException('Environment Maximum Memory Input Unit has not been set.');
        }

        return $this->EnvironmentMaximumMemoryInputUnit;
    }

    public function setWorkerMaximumMemoryValue(int $WorkerMaximumMemoryValue): MemoryInterface
    {
        if ($this->WorkerMaximumMemoryValue !== null) {
            throw new LogicException('Worker Maximum Memory Value is already set.');
        }

        $this->WorkerMaximumMemoryValue = $this->getBytes(
            $WorkerMaximumMemoryValue,
            $this->getWorkerMaximumMemoryInputUnit()
        );

        return $this;
    }

    public function getWorkerMaximumMemoryValue(): int
    {
        if ($this->WorkerMaximumMemoryValue === null) {
            throw new LogicException('Worker Maximum Memory Value has not been set.');
        }

        return $this->WorkerMaximumMemoryValue;
    }

    public function setWorkerMaximumMemoryInputUnit(string $WorkerMaximumMemoryUnit): MemoryInterface
    {
        if ($this->WorkerMaximumMemoryInputUnit !== null) {
            throw new LogicException('Worker Maximum Memory Input Unit is already set.');
        }

        $this->assertValidMemoryUnit($WorkerMaximumMemoryUnit);

        $this->WorkerMaximumMemoryInputUnit = $WorkerMaximumMemoryUnit;

        return $this;
    }

    protected function getWorkerMaximumMemoryInputUnit(): string
    {
        if ($this->WorkerMaximumMemoryInputUnit === null) {
            throw new LogicException('Worker Maximum Memory Input Unit has not been set.');
        }

        return $this->WorkerMaximumMemoryInputUnit;
    }

    protected function getBytes(int $Value, string $Unit): int
    {
        switch ($Unit) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case self::Gibibyte:
                $Value *= 1024;
            /** @noinspection PhpMissingBreakStatementInspection */
            case self::Mebibyte:
                $Value *= 1024;
            case self::Kibibyte:
                $Value *= 1024;
        }

        return $Value;
    }

    protected function assertValidMemoryUnit(string $MemoryUnit): MemoryInterface
    {
        switch ($MemoryUnit) {
            case self::Kibibyte:
            case self::Mebibyte:
            case self::Gibibyte:
                break;
            default:
                throw new InvalidArgumentException(sprintf('Memory Unit [%s] is not KiB, MiB, or GiB.', $MemoryUnit));
        }

        return $this;
    }
}
