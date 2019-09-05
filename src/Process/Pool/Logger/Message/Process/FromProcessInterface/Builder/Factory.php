<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder();
    }
}
