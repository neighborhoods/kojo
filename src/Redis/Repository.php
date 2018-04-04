<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

use Neighborhoods\Kojo\Redis;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Repository implements RepositoryInterface
{
    use Defensive\AwareTrait;
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