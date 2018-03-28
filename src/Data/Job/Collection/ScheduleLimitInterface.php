<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\Job\TypeInterface;
use Neighborhoods\Kojo\Data\Job\CollectionInterface;

interface ScheduleLimitInterface extends CollectionInterface
{
    public function setJobType(TypeInterface $job);

    public function getNumberOfCurrentlyScheduledJobs(): int;
}