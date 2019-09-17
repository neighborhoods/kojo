<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModelInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : FromProcessModelInterface
    {
        return clone $this->getProcessPoolLoggerMessageProcessFromProcessModel();
    }
}
