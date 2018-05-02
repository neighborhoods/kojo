<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;

use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;
use Neighborhoods\Kojo\State\Service;
use Neighborhoods\Kojo\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use FailedScheduleLimitCheck\AwareTrait;
    use Service\AwareTrait;

    public function create(): FailedScheduleLimitCheckInterface
    {
        $updateCompleteFailedScheduleLimitCheck = $this->_getServiceUpdateCompleteFailedScheduleLimitCheckClone();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteFailedScheduleLimitCheck->setStateService($stateService);

        return $updateCompleteFailedScheduleLimitCheck;
    }
}