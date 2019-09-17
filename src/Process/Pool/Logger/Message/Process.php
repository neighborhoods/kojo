<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

class Process implements ProcessInterface
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

    public function getProcessId() : int
    {
        if ($this->process_id === null) {
            throw new \LogicException('Process process_id has not been set.');
        }

        return $this->process_id;
    }

    public function setProcessId(int $process_id) : ProcessInterface
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

    public function setParentProcessId(int $parent_process_id) : ProcessInterface
    {
        if ($this->parent_process_id !== null) {
            throw new \LogicException('Process parent_process_id is already set.');
        }

        $this->parent_process_id = $parent_process_id;

        return $this;
    }

    public function getUuid() : string
    {
        if ($this->uuid === null) {
            throw new \LogicException('Process uuid has not been set.');
        }

        return $this->uuid;
    }

    public function setUuid(string $uuid) : ProcessInterface
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

    public function setTypeCode(string $type_code) : ProcessInterface
    {
        if ($this->type_code !== null) {
            throw new \LogicException('Process type_code is already set.');
        }

        $this->type_code = $type_code;

        return $this;
    }

    public function jsonSerialize()
    {
      return get_object_vars($this);
    }
}
