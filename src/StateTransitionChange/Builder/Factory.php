<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Builder;

use Neighborhoods\Kojo\StateTransitionChange\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getStateTransitionChangeBuilder();
    }
}
