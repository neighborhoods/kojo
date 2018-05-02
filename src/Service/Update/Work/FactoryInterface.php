<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work;

use Neighborhoods\Kojo\Service\Update\WorkInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $stateService);

    public function setServiceUpdateWork(WorkInterface $serviceUpdateWork);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): WorkInterface;
}