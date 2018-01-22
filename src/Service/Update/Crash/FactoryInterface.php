<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Crash;

use NHDS\Jobs\Service\Update\CrashInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $tateService);

    public function setServiceUpdateCrash(CrashInterface $serviceUpdateCrash);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): CrashInterface;
}