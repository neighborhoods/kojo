<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

use Neighborhoods\Kojo\Redis;
use Neighborhoods\Kojo\Process;

class Repository implements RepositoryInterface
{
    use Process\Registry\AwareTrait;
    use Redis\Factory\AwareTrait;
    use Redis\Map\AwareTrait;

    public function get(string $id): \Redis
    {
        $id .= $this->getProcessRegistry()->getLastRegisteredProcess()->getUuid();
        if (!isset($this->getRedisMap()[$id])) {
            $this->getRedisMap()[$id] = $this->getRedisFactory()->create();
        }

        return $this->getRedisMap()[$id];
    }
}