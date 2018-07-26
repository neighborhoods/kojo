<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Builder;

use Neighborhoods\Kojo\Job\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}
