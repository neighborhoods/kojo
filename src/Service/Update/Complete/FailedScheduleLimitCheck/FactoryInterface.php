<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;

use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateCompleteFailedScheduleLimitCheck(
        FailedScheduleLimitCheckInterface $serviceUpdateCompleteFailedScheduleLimitCheck
    );

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): FailedScheduleLimitCheckInterface;
}