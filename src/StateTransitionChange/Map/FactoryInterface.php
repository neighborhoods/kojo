<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map;

use Neighborhoods\Kojo\StateTransitionChange\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : MapInterface;
}
