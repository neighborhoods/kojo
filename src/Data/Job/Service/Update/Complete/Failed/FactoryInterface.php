<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setUpdateCompleteFailed(FailedInterface $updateCompleteFailed);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): FailedInterface;
}