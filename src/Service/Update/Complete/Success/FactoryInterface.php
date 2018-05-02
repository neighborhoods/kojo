<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success;

use Neighborhoods\Kojo\Service\Update\Complete\SuccessInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setStateService(ServiceInterface $jobStateService);

    public function setServiceUpdateCompleteSuccess(SuccessInterface $updateCompleteSuccess);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): SuccessInterface;
}