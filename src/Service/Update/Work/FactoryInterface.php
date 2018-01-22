<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Work;

use NHDS\Jobs\Service\Update\WorkInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateWork(WorkInterface $serviceUpdateWork);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): WorkInterface;
}