<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): JobInterface;
}
