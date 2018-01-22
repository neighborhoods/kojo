<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheck;

use NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateCompleteFailedScheduleLimitCheck(
        FailedScheduleLimitCheckInterface $serviceUpdateCompleteFailedScheduleLimitCheck
    );

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): FailedScheduleLimitCheckInterface;
}