<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : StateTransitionChangeInterface;
}
