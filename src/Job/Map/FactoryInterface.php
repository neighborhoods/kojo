<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Map;

use Neighborhoods\Kojo\Job\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}
