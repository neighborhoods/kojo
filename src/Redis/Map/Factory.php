<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Map;

use Neighborhoods\Kojo\Redis\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getRedisMap()->getArrayCopy();
    }
}
