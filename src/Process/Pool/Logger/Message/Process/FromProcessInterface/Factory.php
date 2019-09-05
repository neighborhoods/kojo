<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterfaceInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : FromProcessInterfaceInterface
    {
        return clone $this->getProcessPoolLoggerMessageProcessFromProcessInterface();
    }
}
