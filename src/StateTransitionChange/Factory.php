<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : StateTransitionChangeInterface
    {
        return clone $this->getStateTransitionChange();
    }
}
