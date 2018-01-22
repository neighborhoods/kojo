<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheck;

use NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheck;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

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