<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map;

use Neighborhoods\Kojo\JobStateChange\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : MapInterface;
}
