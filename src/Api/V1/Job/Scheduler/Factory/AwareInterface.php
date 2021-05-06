<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler\Factory;

use Neighborhoods\Kojo\Api\V1\Job\Scheduler\FactoryInterface;

interface AwareInterface
{
    public function setApiV1JobSchedulerFactory(FactoryInterface $apiV1JobSchedulerFactory);
}
