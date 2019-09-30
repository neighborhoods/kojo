<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use Neighborhoods\Kojo\Data\JobInterface;

class Metadata implements MetadataInterface
{
    /** @var JobInterface */
    protected $job;
    /** @var SerializableProcessInterface */
    protected $process;
    protected $host;

    public function getJob() : JobInterface
    {
        if ($this->job === null) {
            throw new \LogicException('Metadata job has not been set.');
        }

        return $this->job;
    }

    public function setJob(JobInterface $job) : MetadataInterface
    {
        if ($this->job !== null) {
            throw new \LogicException('Metadata job is already set.');
        }

        $this->job = $job;

        return $this;
    }

    public function hasJob() : bool
    {
        return isset($this->job);
    }

    public function getProcess() : SerializableProcessInterface
    {
        if ($this->process === null) {
            throw new \LogicException('Metadata process has not been set.');
        }

        return $this->process;
    }

    public function setProcess(SerializableProcessInterface $process) : MetadataInterface
    {
        if ($this->process !== null) {
            throw new \LogicException('Metadata process is already set.');
        }

        $this->process = $process;

        return $this;
    }

    public function hasProcess() : bool
    {
        return isset($this->process);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
