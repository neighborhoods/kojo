<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map\Builder;

use Neighborhoods\Kojo\JobStateChange\Map\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
