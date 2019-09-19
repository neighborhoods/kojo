<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

class SerializableProcess implements SerializableProcessInterface
{
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
        $this->memory_usage_bytes = memory_get_usage();

        return $this->memory_usage_bytes;
    }

    public function getMemoryPeakUsageBytes() : int
    {
        $this->memory_peak_usage_bytes = memory_get_peak_usage();

        return $this->memory_peak_usage_bytes;
    }

    public function getMemoryLimitBytes() : int
    {
        $this->memory_limit_bytes = $mem_limit = $this->dataUnitToBytes(ini_get('memory_limit'));
        return $this->memory_limit_bytes;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /* converts a number with byte unit (B / K / M / G) into an integer */
    protected function dataUnitToBytes($s)
    {
        return (int)preg_replace_callback('/(\-?\d+)(.?)/', function ($m) {
            return $m[1] * pow(1024, strpos('BKMG', $m[2]));
        }, strtoupper($s));
    }
}
