<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash;

use Neighborhoods\Kojo\Service\Update\CrashInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $tateService);

    public function setServiceUpdateCrash(CrashInterface $serviceUpdateCrash);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): CrashInterface;
}