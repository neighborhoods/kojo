<?php
declare(strict_types=1);

namespace NHDS\Jobs\Redis;

use NHDS\Jobs\Redis;
use NHDS\Jobs\Process;
use NHDS\Toolkit\Data\Property\Strict;

class Repository implements RepositoryInterface
{
    use Strict\AwareTrait;
    use Redis\Factory\AwareTrait;
    use Process\Registry\AwareTrait;
    protected $_redisCollection = [];

    public function getById(string $id): \Redis
    {
        $id .= $this->_getProcessRegistry()->getLastRegisteredProcess()->getUuid();
        if (!isset($this->_redisCollection[$id])) {
            $this->_redisCollection[$id] = $this->_getRedisFactory()->create();
        }

        return $this->_redisCollection[$id];
    }
}