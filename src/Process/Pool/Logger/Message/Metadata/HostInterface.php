<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

interface HostInterface extends \JsonSerializable
{
    public function getHostName() : string;

    public function getLoadAverage() : float;
}
