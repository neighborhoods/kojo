<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;

use Neighborhoods\Kojo\ProcessInterface;

class FromProcessModel implements FromProcessModelInterface
{
    /** @var ProcessInterface */
    protected $processInterface;

    public function setProcessInterface(ProcessInterface $processInterface) : FromProcessModelInterface
    {
        if ($this->processInterface !== null) {
            throw new \LogicException('FromProcessModel processInterface is already set.');
        }

        $this->processInterface = $processInterface;

        return $this;
    }

    protected function getProcessInterface() : ProcessInterface
    {
        if ($this->processInterface === null) {
            throw new \LogicException('FromProcessModel processInterface has not been set.');
        }

        return $this->processInterface;
    }
}
