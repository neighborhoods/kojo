<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setUpdateCompleteFailedScheduleLimitCheck(
        FailedScheduleLimitCheckInterface $updateCompleteFailedScheduleLimitCheck
    );

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): FailedScheduleLimitCheckInterface;
}