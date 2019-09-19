<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data\Builder;

use Neighborhoods\Kojo\StateTransitionChange\Data\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getStateTransitionChangeDataBuilder();
    }
}
