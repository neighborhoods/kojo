<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\Service\Create;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;
use NHDS\Jobs\Api\Service\CreateInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit);

    public function setStateService(ServiceInterface $jobStateService);

    public function setServiceCreate(CreateInterface $jobServiceUpdateCrash);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): CreateInterface;
}