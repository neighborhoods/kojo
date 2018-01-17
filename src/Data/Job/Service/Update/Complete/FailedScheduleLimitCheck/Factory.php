<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use FailedScheduleLimitCheck\AwareTrait;
    use Service\AwareTrait;

    public function create(): FailedScheduleLimitCheckInterface
    {
        $updateCompleteFailedScheduleLimitCheck = $this->_getUpdateCompleteFailedScheduleLimitCheckClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteFailedScheduleLimitCheck->setJobStateService($stateService);

        return $updateCompleteFailedScheduleLimitCheck;
    }
}