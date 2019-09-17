<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface as MessageProcessInterface;
use Neighborhoods\Kojo\ProcessInterface as ProcessModelInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use \Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\Factory\AwareTrait;
    /** @var ProcessModelInterface */
    protected $processModelInterface;

    public function build() : MessageProcessInterface
    {
        $process = $this->getProcessPoolLoggerMessageProcessFactory()->create();
        $process->setProcessId($this->getProcessModelInterface()->getProcessId());
        $process->setParentProcessId($this->getProcessModelInterface()->getParentProcessId());
        $process->setPath($this->getProcessModelInterface()->getPath());
        $process->setUuid($this->getProcessModelInterface()->getUuid());
        $process->setTypeCode($this->getProcessModelInterface()->getTypeCode());

        return $process;
    }

    public function getProcessModelInterface() : ProcessModelInterface
    {
        if ($this->processModelInterface === null) {
            throw new \LogicException('Builder processInterface has not been set.');
        }

        return $this->processModelInterface;
    }

    public function setProcessModelInterface(ProcessModelInterface $processModelInterface) : BuilderInterface
    {
        if ($this->processModelInterface !== null) {
            throw new \LogicException('Builder processInterface is already set.');
        }

        $this->processModelInterface = $processModelInterface;

        return $this;
    }
}
