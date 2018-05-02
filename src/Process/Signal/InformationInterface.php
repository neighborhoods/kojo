<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal;

interface InformationInterface
{
    public const SYSTEM_TIME_CONSUMED       = 'stime';
    public const FILE_DESCRIPTOR_NUMBER     = 'fd';
    public const ERROR_NUMBER               = 'errno';
    public const BAND_EVENT                 = 'band';
    public const SIGNAL_NUMBER              = 'signo';
    public const SIGNAL_CODE                = 'code';
    public const EXIT_VALUE                 = 'status';
    public const USER_ID                    = 'uid';
    public const USER_TIME_CONSUMED         = 'utime';
    public const SEGMENTATION_FAULT_ADDRESS = 'addr';
    public const PROCESS_ID                 = 'pid';

    public function hydrate(array $information): InformationInterface;

    public function getSignalNumber(): int;

    public function getErrorNumber(): int;

    public function getSignalCode(): int;

    public function hasExitValue(): bool;

    public function getExitValue(): int;

    public function hasUserTimeConsumed(): bool;

    public function getUserTimeConsumed(): int;

    public function hasSystemTimeConsumed(): bool;

    public function getSystemTimeConsumed(): int;

    public function hasProcessId(): bool;

    public function getProcessId(): int;

    public function hasUserId(): bool;

    public function getUserId(): int;

    public function hasSegmentationFaultAddress(): bool;

    public function getSegmentationFaultAddress(): int;

    public function hasBandEvent(): bool;

    public function getBandEvent(): int;

    public function hasFileDescriptorNumber(): bool;

    public function getFileDescriptorNumber(): int;
}