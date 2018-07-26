<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\ScheduleLimit;

use Neighborhoods\Kojo\Job\Collection\ScheduleLimitInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): ScheduleLimitInterface;
}
