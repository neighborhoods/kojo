<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

class SerializableProcess implements SerializableProcessInterface
{
    const KEY_MEMORY_USAGE_BYTES = 'memory_usage_bytes';
    const KEY_MEMORY_PEAK_USAGE_BYTES = 'memory_peak_usage_bytes';
    const KEY_MEMORY_LIMIT_BYTES = 'memory_limit_bytes';

    /** @var int  */
    protected $process_id;
    /** @var int */
    protected $parent_process_id;
    /** @var string */
    protected $path;
    /** @var string */
    protected $uuid;
    /** @var string */
    protected $type_code;
    /** @var int */
    protected $memory_usage_bytes;
    /** @var int */
    protected $memory_peak_usage_bytes;
    /** @var int */
    protected $memory_limit_bytes;

    public function getProcessId() : int
    {
        if ($this->process_id === null) {
            throw new \LogicException('Process process_id has not been set.');
        }

        return $this->process_id;
    }

    public function setProcessId(int $process_id) : SerializableProcessInterface
    {
        if ($this->process_id !== null) {
            throw new \LogicException('Process process_id is already set.');
        }

        $this->process_id = $process_id;

        return $this;
    }

    public function getParentProcessId() : int
    {
        if ($this->parent_process_id === null) {
            throw new \LogicException('Process parent_process_id has not been set.');
        }

        return $this->parent_process_id;
    }

    public function setParentProcessId(int $parent_process_id) : SerializableProcessInterface
    {
        if ($this->parent_process_id !== null) {
            throw new \LogicException('Process parent_process_id is already set.');
        }

        $this->parent_process_id = $parent_process_id;

        return $this;
    }

    public function getPath() : string
    {
        if ($this->path === null) {
            throw new \LogicException('SerializableProcess path has not been set.');
        }

        return $this->path;
    }

    public function setPath(string $path) : SerializableProcessInterface
    {
        if ($this->path !== null) {
            throw new \LogicException('SerializableProcess path is already set.');
        }

        $this->path = $path;

        return $this;
    }

    public function getUuid() : string
    {
        if ($this->uuid === null) {
            throw new \LogicException('Process uuid has not been set.');
        }

        return $this->uuid;
    }

    public function setUuid(string $uuid) : SerializableProcessInterface
    {
        if ($this->uuid !== null) {
            throw new \LogicException('Process uuid is already set.');
        }

        $this->uuid = $uuid;

        return $this;
    }

    public function getTypeCode() : string
    {
        if ($this->type_code === null) {
            throw new \LogicException('Process type_code has not been set.');
        }

        return $this->type_code;
    }

    public function setTypeCode(string $type_code) : SerializableProcessInterface
    {
        if ($this->type_code !== null) {
            throw new \LogicException('Process type_code is already set.');
        }

        $this->type_code = $type_code;

        return $this;
    }

    public function getMemoryUsageBytes() : int
    {
        return  memory_get_usage();
    }

    public function getMemoryPeakUsageBytes() : int
    {
        return memory_get_peak_usage();
    }

    public function getMemoryLimitBytes() : int
    {
        return $this->dataUnitToBytes(ini_get('memory_limit'));
    }

    public function jsonSerialize()
    {
        $data = get_object_vars($this);
        $data[self::KEY_MEMORY_USAGE_BYTES]= $this->getMemoryUsageBytes();
        $data[self::KEY_MEMORY_PEAK_USAGE_BYTES]= $this->getMemoryPeakUsageBytes();
        $data[self::KEY_MEMORY_LIMIT_BYTES]= $this->getMemoryLimitBytes();
        return $data;
    }

    /* converts a number with byte unit (B / K / M / G) into an integer */
    protected function dataUnitToBytes(string $memoryString) : int
    {
        $memoryString = trim($memoryString);
        $lastCharacter = strtolower($memoryString[-1]);
        switch ($lastCharacter) {
            case 'g':
                $bytes = (int)$memoryString * 1024 * 1024 * 1024;
                break;
            case 'm':
                $bytes = (int)$memoryString * 1024 * 1024;
                break;
            case 'k':
                $bytes = (int)$memoryString * 1024;
                break;
            default:
                $bytes = (int)$memoryString;
        }

        return $bytes;
    }
}
