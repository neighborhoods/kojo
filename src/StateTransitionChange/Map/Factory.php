<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map;

use Neighborhoods\Kojo\StateTransitionChange\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : MapInterface
    {
        return $this->getStateTransitionChangeMap()->getArrayCopy();
    }
}
