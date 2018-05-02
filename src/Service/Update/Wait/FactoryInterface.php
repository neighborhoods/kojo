<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Wait;

use Neighborhoods\Kojo\Service\Update\WaitInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateWait(WaitInterface $serviceUpdateWait);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): WaitInterface;
}