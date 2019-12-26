<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : FromArrayBuilderInterface
    {
        return clone $this->getProcessPoolLoggerMessageMetadataFromArrayBuilder();
    }
}
