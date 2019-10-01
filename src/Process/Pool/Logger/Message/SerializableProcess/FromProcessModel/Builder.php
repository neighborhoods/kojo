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
        $processModel = $this->getProcessModelInterface();

        $serializableProcess = $this->getProcessPoolLoggerMessageSerializableProcessFactory()->create();

        $serializableProcess->setProcessId($processModel->getProcessId());
        $serializableProcess->setParentProcessId($processModel->getParentProcessId());
        $serializableProcess->setPath($processModel->getPath());
        $serializableProcess->setUuid($processModel->getUuid());
        $serializableProcess->setTypeCode($processModel->getTypeCode());

        return $serializableProcess;
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
