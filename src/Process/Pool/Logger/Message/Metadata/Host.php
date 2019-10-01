<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

class Host implements HostInterface
{
    const KEY_HOST_NAME = 'host_name';
    const KEY_LOAD_AVERAGE = 'load_average';

    /** @var string */
    protected $host_name;
    /** @var float */
    protected $load_average;

    public function getHostName() : string
    {
        return gethostname();
    }

    public function setHostName(string $host_name) : HostInterface
    {
        if ($this->host_name !== null) {
            throw new \LogicException('Host host_name is already set.');
        }
        $this->host_name = $host_name;
        return $this;
    }

    public function getLoadAverage() : float
    {
        return (float)current(sys_getloadavg());
    }

    public function setLoadAverage(float $load_average) : HostInterface
    {
        if ($this->load_average !== null) {
            throw new \LogicException('Host load_average is already set.');
        }
        $this->load_average = $load_average;
        return $this;
    }

    public function jsonSerialize()
    {
        $data = get_object_vars($this);

        if (!isset($data[self::KEY_HOST_NAME])) {
            $data[self::KEY_HOST_NAME] = $this->getHostName();
        }
        if (!isset($data[self::KEY_LOAD_AVERAGE])) {
            $data[self::KEY_LOAD_AVERAGE] = $this->getLoadAverage();
        }

        return $data;
    }
}
