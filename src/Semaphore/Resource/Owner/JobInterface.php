<?php
declare(strict_types=1);

namespace NHDS\Jobs\Semaphore\Resource\Owner;

use NHDS\Jobs\Semaphore\Resource\OwnerInterface;
use NHDS\Jobs\Data;

interface JobInterface extends OwnerInterface
{
    public function setJob(Data\JobInterface $job);
}