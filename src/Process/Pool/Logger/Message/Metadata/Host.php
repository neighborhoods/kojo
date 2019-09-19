<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

class Host implements HostInterface
{
    /** @var string */
    protected $host_name;
    /** @var float */
    protected $load_average;

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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
