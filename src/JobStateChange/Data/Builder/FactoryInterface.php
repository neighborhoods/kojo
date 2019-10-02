<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data\Builder;

use Neighborhoods\Kojo\JobStateChange\Data\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
