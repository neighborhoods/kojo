<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\ProcessInterface;

class FromProcessInterface implements FromProcessInterfaceInterface
{
    /** @var ProcessInterface */
    protected $processInterface;

    public function setProcessInterface(ProcessInterface $processInterface) : FromProcessInterfaceInterface
    {
        if ($this->processInterface !== null) {
            throw new \LogicException('FromProcessInterface processInterface is already set.');
        }

        $this->processInterface = $processInterface;

        return $this;
    }

    protected function getProcessInterface() : ProcessInterface
    {
        if ($this->processInterface === null) {
            throw new \LogicException('FromProcessInterface processInterface has not been set.');
        }

        return $this->processInterface;
    }
}
