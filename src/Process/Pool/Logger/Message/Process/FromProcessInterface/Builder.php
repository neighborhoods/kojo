<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterfaceInterface;
use Neighborhoods\Kojo\ProcessInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    /** @var ProcessInterface */
    protected $processInterface;

    public function build() : FromProcessInterfaceInterface
    {
        $fromProcessInterface = $this->getProcessPoolLoggerMessageProcessFromProcessInterfaceFactory()->create();
        $fromProcessInterface->setProcessInterface($this->getProcessInterface());

        return $fromProcessInterface;
    }

    public function getProcessInterface() : ProcessInterface
    {
        if ($this->processInterface === null) {
            throw new \LogicException('Builder processInterface has not been set.');
        }

        return $this->processInterface;
    }

    public function setProcessInterface(ProcessInterface $processInterface) : BuilderInterface
    {
        if ($this->processInterface !== null) {
            throw new \LogicException('Builder processInterface is already set.');
        }

        $this->processInterface = $processInterface;

        return $this;
    }
}
