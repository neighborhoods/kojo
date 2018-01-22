<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\Success;

use NHDS\Jobs\Service\Update\Complete\SuccessInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $jobStateService);

    public function setServiceUpdateCompleteSuccess(SuccessInterface $updateCompleteSuccess);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): SuccessInterface;
}