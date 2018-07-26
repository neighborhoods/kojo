<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner\Job;

use Neighborhoods\Kojo\Semaphore\Resource\Owner\JobInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): JobInterface;
}
