<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Builder;

use Neighborhoods\Kojo\JobStateChange\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
