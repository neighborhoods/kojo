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

    public function getLoadAverage() : float
    {
        return (float)current(sys_getloadavg());
    }

    public function jsonSerialize()
    {
        $data = get_object_vars($this);
        $data[self::KEY_HOST_NAME] = $this->getHostName();
        $data[self::KEY_LOAD_AVERAGE] = $this->getLoadAverage();

        return $data;
    }
}
