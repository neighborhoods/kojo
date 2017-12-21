<?php

namespace NHDS\Jobs\Data\Job\Service\Create;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;
use NHDS\Jobs\Data\Job\Service\CreateInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit);

    public function setJobStateService(ServiceInterface $jobStateService);

    public function setJobServiceCreate(CreateInterface $jobServiceUpdateCrash);

    public function setName(string $factoryName): FactoryInterface;

    public function create(): CreateInterface;
}