<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Crash;

use NHDS\Jobs\Data\Job\Service\Update\CrashInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setJobServiceUpdateCrash(CrashInterface $jobServiceUpdateCrash);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): CrashInterface;
}