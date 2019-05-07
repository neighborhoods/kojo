<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Environment;

interface MemoryInterface
{
    public const Gibibyte = 'GiB';
    public const Mebibyte = 'MiB';
    public const Kibibyte = 'KiB';

    public function setEnvironmentMaximumMemoryValue(int $EnvironmentMaximumMemoryValue): MemoryInterface;

    public function setWorkerMaximumMemoryInputUnit(string $WorkerMaximumMemoryUnit): MemoryInterface;

    public function getMaximumNumberOfWorkers(): int;

    public function setWorkerMaximumMemoryValue(int $WorkerMaximumMemoryValue): MemoryInterface;

    public function setEnvironmentMaximumMemoryInputUnit(string $EnvironmentMaximumMemoryUnit): MemoryInterface;

    public function getWorkerMaximumMemoryValue(): int;
}
