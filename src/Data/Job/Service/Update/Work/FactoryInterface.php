<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Work;

use NHDS\Jobs\Data\Job\Service\Update\WorkInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setJobServiceUpdateWork(WorkInterface $jobServiceUpdateWork);

    public function setName(string $factoryName): FactoryInterface;

    public function create(): WorkInterface;
}