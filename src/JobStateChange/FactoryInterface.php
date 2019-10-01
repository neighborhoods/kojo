<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\JobStateChangeInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : JobStateChangeInterface;
}
