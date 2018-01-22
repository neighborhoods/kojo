<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Retry;

use NHDS\Jobs\Service\Update\RetryInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateRetry(RetryInterface $serviceUpdateRetry);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): RetryInterface;
}