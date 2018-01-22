<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Panic;

use NHDS\Jobs\Service\Update\PanicInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdatePanic(PanicInterface $serviceUpdatePanic);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): PanicInterface;
}