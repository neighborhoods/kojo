<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Map;

use Neighborhoods\Kojo\Process\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}
