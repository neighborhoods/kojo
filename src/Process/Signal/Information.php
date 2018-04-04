<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal;

use Neighborhoods\Pylon\Data\Property\Defensive;

class Information implements InformationInterface
{
    use Defensive\AwareTrait;
    protected $_information;

    public function hydrate(array $information): InformationInterface
    {
        if ($this->_information === null) {
            $this->_information = $information;
        }

        return $this;
    }

    public function getSignalNumber(): int
    {
        if (!isset($this->_information[self::SIGNAL_NUMBER])) {
            throw new \RuntimeException('Signal number is not set.');
        }

        return $this->_information[self::SIGNAL_NUMBER];
    }

    public function getErrorNumber(): int
    {
        if (!isset($this->_information[self::ERROR_NUMBER])) {
            throw new \RuntimeException('Error number is not set.');
        }

        return $this->_information[self::ERROR_NUMBER];
    }

    public function getSignalCode(): int
    {
        if (!isset($this->_information[self::SIGNAL_CODE])) {
            throw new \RuntimeException('Signal code is not set.');
        }

        return $this->_information[self::SIGNAL_CODE];
    }

    public function hasExitValue(): bool
    {
        return isset($this->_information[self::EXIT_VALUE]) ? true : false;
    }

    public function getExitValue(): int
    {
        if (!isset($this->_information[self::EXIT_VALUE])) {
            throw new \LogicException('Exit value is not set.');
        }

        return $this->_information[self::EXIT_VALUE];
    }

    public function hasUserTimeConsumed(): bool
    {
        return isset($this->_information[self::USER_TIME_CONSUMED]) ? true : false;
    }

    public function getUserTimeConsumed(): int
    {
        if (!isset($this->_information[self::USER_TIME_CONSUMED])) {
            throw new \LogicException('User time consumed is not set.');
        }

        return $this->_information[self::USER_TIME_CONSUMED];
    }

    public function hasSystemTimeConsumed(): bool
    {
        return isset($this->_information[self::SYSTEM_TIME_CONSUMED]) ? true : false;
    }

    public function getSystemTimeConsumed(): int
    {
        if (!isset($this->_information[self::SYSTEM_TIME_CONSUMED])) {
            throw new \LogicException('System time consumed is not set.');
        }

        return $this->_information[self::SYSTEM_TIME_CONSUMED];
    }

    public function hasProcessId(): bool
    {
        return isset($this->_information[self::PROCESS_ID]) ? true : false;
    }

    public function getProcessId(): int
    {
        if (!isset($this->_information[self::PROCESS_ID])) {
            throw new \LogicException('Process ID is not set.');
        }

        return $this->_information[self::PROCESS_ID];
    }

    public function hasUserId(): bool
    {
        return isset($this->_information[self::USER_ID]) ? true : false;
    }

    public function getUserId(): int
    {
        if (!isset($this->_information[self::USER_ID])) {
            throw new \LogicException('User ID is not set.');
        }

        return $this->_information[self::USER_ID];
    }

    public function hasSegmentationFaultAddress(): bool
    {
        return isset($this->_information[self::SEGMENTATION_FAULT_ADDRESS]) ? true : false;
    }

    public function getSegmentationFaultAddress(): int
    {
        if (!isset($this->_information[self::SEGMENTATION_FAULT_ADDRESS])) {
            throw new \LogicException('Segmentation fault address is not set.');
        }

        return $this->_information[self::SEGMENTATION_FAULT_ADDRESS];
    }

    public function hasBandEvent(): bool
    {
        return isset($this->_information[self::BAND_EVENT]) ? true : false;
    }

    public function getBandEvent(): int
    {
        if (!isset($this->_information[self::BAND_EVENT])) {
            throw new \LogicException('Band event is not set.');
        }

        return $this->_information[self::BAND_EVENT];
    }

    public function hasFileDescriptorNumber(): bool
    {
        return isset($this->_information[self::FILE_DESCRIPTOR_NUMBER]) ? true : false;
    }

    public function getFileDescriptorNumber(): int
    {
        if (!isset($this->_information[self::FILE_DESCRIPTOR_NUMBER])) {
            throw new \LogicException('File descriptor number is not set.');
        }

        return $this->_information[self::FILE_DESCRIPTOR_NUMBER];
    }
}