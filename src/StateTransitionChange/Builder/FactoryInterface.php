<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Builder;

use Neighborhoods\Kojo\StateTransitionChange\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
