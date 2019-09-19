<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map\Builder;

use Neighborhoods\Kojo\StateTransitionChange\Map\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getStateTransitionChangeMapBuilder();
    }
}
