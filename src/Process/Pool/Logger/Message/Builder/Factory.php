<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getProcessPoolLoggerMessageBuilder();
    }
}
