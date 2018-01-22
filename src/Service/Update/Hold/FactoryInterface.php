<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Hold;

use NHDS\Jobs\Service\Update\HoldInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateHold(HoldInterface $serviceUpdateHold);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): HoldInterface;
}