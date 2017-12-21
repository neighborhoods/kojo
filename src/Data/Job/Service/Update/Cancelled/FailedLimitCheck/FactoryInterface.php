<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheckInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setJobServiceUpdateCancelledFailedLimitCheck(FailedLimitCheckInterface $jobServiceUpdateCancelledFailedLimitCheck);

    public function setName(string $factoryName): FactoryInterface;

    public function create(): FailedLimitCheckInterface;
}