<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Panic;

use NHDS\Jobs\Data\Job\Service\Update\PanicInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setJobServiceUpdatePanic(PanicInterface $jobServiceUpdatePanic);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): PanicInterface;
}