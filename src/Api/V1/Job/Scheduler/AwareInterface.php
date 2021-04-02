<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler;

use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;

interface AwareInterface
{
    public function setApiV1JobScheduler(SchedulerInterface $apiV1JobScheduler);
}
