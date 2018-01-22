<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\Failed;

use NHDS\Jobs\Service\Update\Complete\FailedInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateCompleteFailed(FailedInterface $serviceUpdateCompleteFailed);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): FailedInterface;
}