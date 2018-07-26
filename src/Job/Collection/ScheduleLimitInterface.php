<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection;

use Neighborhoods\Kojo\Job\TypeInterface;
use Neighborhoods\Kojo\Job\CollectionInterface;

interface ScheduleLimitInterface extends CollectionInterface
{
    public function setJobType(TypeInterface $job);

    public function getNumberOfCurrentlyScheduledJobs(): int;

    public function incrementNumberOfCurrentlyScheduledJobs(): ScheduleLimitInterface;
}