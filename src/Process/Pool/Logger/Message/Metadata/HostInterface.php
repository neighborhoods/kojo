<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

interface HostInterface extends \JsonSerializable
{

    public function getMemoryLimitBytes() : int;

    public function getLoadAverage() : float;

    public function getHostName() : string;

    public function getMemoryUsageBytes() : int;

    public function getPeakMemoryUsageBytes() : int;
}
