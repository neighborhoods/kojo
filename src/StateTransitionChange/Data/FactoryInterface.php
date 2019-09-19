<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data;

use Neighborhoods\Kojo\StateTransitionChange\DataInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : DataInterface;
}
