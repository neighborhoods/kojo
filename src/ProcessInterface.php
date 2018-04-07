<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Process\Pool\LoggerInterface;
use Neighborhoods\Kojo\Process\PoolInterface;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

interface ProcessInterface extends HandlerInterface
{
    const PROP_THROTTLE                                 = 'throttle';
    const PROP_EXIT_CODE                                = 'exit_code';
    const PROP_PATH                                     = 'path';
    const PROP_TERMINATION_SIGNAL_NUMBER                = 'termination_signal_number';
    const PROP_PROCESS_ID                               = 'process_id';
    const PROP_TYPE_CODE                                = 'type_code';
    const PROP_UUID                                     = 'uuid';
    const PROP_UUID_MAXIMUM_INTEGER                     = 'uuid_maximum_integer';
    const PROP_PARENT_PROCESS_ID                        = 'parent_process_id';
    const PROP_PARENT_PROCESS_PATH                      = 'parent_process_path';
    const PROP_PARENT_PROCESS_UUID                      = 'parent_process_uuid';
    const PROP_PARENT_PROCESS_TERMINATION_SIGNAL_NUMBER = 'parent_process_termination_signal_number';

    public function start(): ProcessInterface;

    public function getProcessId(): int;

    public function setLogger(LoggerInterface $logger);

    public function setThrottle(int $seconds = 0): ProcessInterface;

    public function setExitCode(int $exitCode): ProcessInterface;

    public function getExitCode(): int;

    public function getParentProcessId(): int;

    public function getTypeCode(): string;

    public function setTypeCode(string $typeCode): ProcessInterface;

    public function setProcessPool(PoolInterface $pool);

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

    public function exit(int $exitCode);
}