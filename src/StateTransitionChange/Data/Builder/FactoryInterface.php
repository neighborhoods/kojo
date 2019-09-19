<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data\Builder;

use Neighborhoods\Kojo\StateTransitionChange\Data\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
