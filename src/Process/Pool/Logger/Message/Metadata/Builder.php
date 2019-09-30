<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;
use Neighborhoods\Kojo\ProcessInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use SerializableProcess\FromProcessModel\Builder\Factory\AwareTrait;
    use Host\AwareTrait;

    /** @var ProcessInterface */
    protected $process;
    /** @var JobInterface */
    protected $job;

    public function build() : MetadataInterface
    {
        $metadata = $this->getProcessPoolLoggerMessageMetadataFactory()->create();

        if ($this->hasProcess()) {
            $serializableProcess = $this->getProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory()
                ->create()
                ->setProcessModelInterface($this->getProcess())
                ->build();

            $metadata->setProcess($serializableProcess);
        }

        if ($this->hasJob()){
            $metadata->setJob($this->getJob());
        }

        $metadata->setHost($this->getProcessPoolLoggerMessageMetadataHost());

        return $metadata;
    }

    public function getProcess() : ProcessInterface
    {
        if ($this->process === null) {
            throw new \LogicException('Builder process has not been set.');
        }

        return $this->process;
    }

    public function setProcess(ProcessInterface $process) : BuilderInterface
    {

        $this->process = $process;

        return $this;
    }

    public function hasProcess() : bool
    {
        return isset($this->process);
    }

    public function getJob() : JobInterface
    {
        if ($this->job === null) {
            throw new \LogicException('Builder job has not been set.');
        }

        return $this->job;
    }

    public function setJob(JobInterface $job) : BuilderInterface
    {
        if ($this->job !== null) {
            throw new \LogicException('Builder job is already set.');
        }

        $this->job = $job;

        return $this;
    }

    public function hasJob() : bool
    {
        return isset($this->job);
    }
}
