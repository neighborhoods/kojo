<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic;

use Neighborhoods\Kojo\Service\Update\PanicInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdatePanic(PanicInterface $serviceUpdatePanic);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): PanicInterface;
}