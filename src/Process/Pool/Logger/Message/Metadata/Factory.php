<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : MetadataInterface
    {
        return clone $this->getProcessPoolLoggerMessageMetadata();
    }
}
