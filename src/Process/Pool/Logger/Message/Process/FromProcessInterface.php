<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\ProcessInterface;

class FromProcessInterface implements FromProcessInterfaceInterface
{
    /** @var ProcessInterface */
    protected $processInterface;


    public function jsonSerialize()
    {
        $process = $this->getProcessInterface();

        $usefulStuff = [
            ProcessInterface::PROP_PROCESS_ID => $process->getProcessId(),
            ProcessInterface::PROP_PARENT_PROCESS_ID => $process->getParentProcessId(),
            ProcessInterface::PROP_PATH => $process->getPath(),
            ProcessInterface::PROP_UUID => $process->getUuid(),
            ProcessInterface::PROP_TYPE_CODE => $process->getTypeCode(),
        ];

        return $usefulStuff;
    }

    public function setProcessInterface(ProcessInterface $processInterface) : FromProcessInterfaceInterface
    {
        if ($this->processInterface !== null) {
            throw new \LogicException('FromProcessInterface processInterface is already set.');
        }

        $this->processInterface = $processInterface;

        return $this;
    }
}
