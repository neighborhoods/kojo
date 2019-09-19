<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map\Builder;

use Neighborhoods\Kojo\StateTransitionChange\Map\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
