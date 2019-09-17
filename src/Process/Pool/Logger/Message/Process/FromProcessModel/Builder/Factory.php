<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getProcessPoolLoggerMessageProcessFromProcessModelBuilder();
    }
}
