<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Wait;

use NHDS\Jobs\Data\Job\Service\Update\WaitInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setJobServiceUpdateWait(WaitInterface $jobServiceUpdateWait);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): WaitInterface;
}