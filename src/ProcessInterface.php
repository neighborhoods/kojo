<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

interface ProcessInterface extends HandlerInterface
{
    public function start(): ProcessInterface;

    public function getProcessId(): int;

    public function setLogger(LoggerInterface $logger);

    public function setThrottle(int $seconds = 0): ProcessInterface;

    public function setExitCode(int $exitCode): ProcessInterface;

    public function getExitCode(): int;

    public function getParentProcessId(): int;

    public function setParentProcessPath(string $parentProcessPath): ProcessInterface;

    public function getPath(): string;

    public function setTerminationSignalNumber(int $terminationSignalNumber): ProcessInterface;

    public function getTerminationSignalNumber(): int;

    public function getUuid(): string;

    public function setUuidMaximumInteger(int $uuidMaximumInteger): ProcessInterface;

    public function setParentProcessUuid(string $parentProcessUuid): ProcessInterface;

    public function getParentProcessUuid(): string;

    public function getParentProcessTerminationSignalNumber();

    public function setParentProcessTerminationSignalNumber(int $parentProcessTerminationSignalNumber);

    public function exit(): void;

    public function shutdown(): ProcessInterface;

    public function unregisterShutdownMethod(): ProcessInterface;

    public function getTypeId(): string;
}