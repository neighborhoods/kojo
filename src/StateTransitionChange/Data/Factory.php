<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data;

use Neighborhoods\Kojo\StateTransitionChange\DataInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : DataInterface
    {
        return clone $this->getStateTransitionChangeData();
    }
}
