<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed;

use Neighborhoods\Kojo\Service\Update\Complete\FailedInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateCompleteFailed(FailedInterface $serviceUpdateCompleteFailed);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): FailedInterface;
}