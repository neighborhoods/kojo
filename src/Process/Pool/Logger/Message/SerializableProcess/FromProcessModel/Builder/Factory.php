<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder();
    }
}
