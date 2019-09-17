<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\ProcessInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : ProcessInterface
    {
        return clone $this->getProcessPoolLoggerMessageProcess();
    }
}
