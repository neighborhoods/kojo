<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\HostInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    public function build() : HostInterface
    {
        $host = $this->getProcessPoolLoggerMessageMetadataHostFactory()->create();

        $host->getHostName();
        $host->getLoadAverage();
        $host->getMemoryUsageBytes();
        $host->getPeakMemoryUsageBytes();
        $host->getMemoryLimitBytes();

        return $host;
    }
}
