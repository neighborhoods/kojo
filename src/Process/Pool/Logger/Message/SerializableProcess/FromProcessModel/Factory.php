<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModelInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : FromProcessModelInterface
    {
        return clone $this->getProcessPoolLoggerMessageSerializableProcessFromProcessModel();
    }
}
