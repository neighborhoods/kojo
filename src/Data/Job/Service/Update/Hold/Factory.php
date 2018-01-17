<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Hold;

use NHDS\Jobs\Data\Job\Service\Update\HoldInterface;
use NHDS\Jobs\Data\Job\Service\Update\Hold;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Hold\AwareTrait;
    use Service\AwareTrait;

    public function create(): HoldInterface
    {
        $updateCompleteHold = $this->_getUpdateHold();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteHold->setJobStateService($stateService);

        return $updateCompleteHold;
    }
}