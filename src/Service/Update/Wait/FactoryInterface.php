<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Wait;

use NHDS\Jobs\Service\Update\WaitInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateWait(WaitInterface $serviceUpdateWait);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): WaitInterface;
}