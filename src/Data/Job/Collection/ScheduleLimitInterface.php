<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Jobs\Data\Job\CollectionInterface;

interface ScheduleLimitInterface extends CollectionInterface
{
    public function setJobType(TypeInterface $job);

    public function getNumberOfCurrentlyScheduledJobs(): int;
}