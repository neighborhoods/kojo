<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler;

use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface
{
    public function create(): SchedulerInterface;

    /** @injected:configuration */
    public function setApiV1JobScheduler(SchedulerInterface $apiV1JobScheduler);

    /** @injected:configuration */
    public function setServiceCreateFactory(Service\Create\FactoryInterface $serviceCreateFactory);
}