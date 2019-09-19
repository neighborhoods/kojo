<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\HostInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : HostInterface
    {
        return clone $this->getProcessPoolLoggerMessageMetadataHost();
    }
}
