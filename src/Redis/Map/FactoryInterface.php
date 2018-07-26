<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Map;

use Neighborhoods\Kojo\Redis\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}
