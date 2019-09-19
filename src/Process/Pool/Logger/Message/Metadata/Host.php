<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

class Host implements HostInterface
{
    /** @var string */
    protected $host_name;
    /** @var float */
    protected $load_average;
    /** @var int */
    protected $memory_usage_bytes;
    /** @var int */
    protected $peak_memory_usage_bytes;
    /** @var int */
    protected $memory_limit_bytes;

    public function getHostName() : string
    {
        $this->host_name = gethostname();

        return $this->host_name;
    }

    public function getLoadAverage() : float
    {
        $this->load_average = (float)current(sys_getloadavg());

        return $this->load_average;
    }

    public function getMemoryUsageBytes() : int
    {
        $this->memory_usage_bytes = memory_get_usage();

        return $this->memory_usage_bytes;
    }

    public function getPeakMemoryUsageBytes() : int
    {
        $this->peak_memory_usage_bytes = memory_get_peak_usage();

        return $this->peak_memory_usage_bytes;
    }

    public function getMemoryLimitBytes() : int
    {
        $this->memory_limit_bytes = $mem_limit = $this->dataUnitToBytes(ini_get('memory_limit'));
        return $this->memory_limit_bytes;
    }

    public function jsonSerialize()
    {
        $this->getHostName();
        $this->getLoadAverage();
        $this->getMemoryUsageBytes();
        $this->getPeakMemoryUsageBytes();
        $this->getMemoryLimitBytes();

        return get_object_vars($this);
    }

    /* converts a number with byte unit (B / K / M / G) into an integer */
    protected function dataUnitToBytes($s)
    {
        return (int)preg_replace_callback('/(\-?\d+)(.?)/', function ($m) {
            return $m[1] * pow(1024, strpos('BKMG', $m[2]));
        }, strtoupper($s));
    }
}
