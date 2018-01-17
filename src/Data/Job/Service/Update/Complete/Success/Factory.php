<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Success;

use NHDS\Jobs\Data\Job\Service\Update\Complete\SuccessInterface;
use NHDS\Jobs\Data\Job\Service\Update\Complete\Success;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Success\AwareTrait;
    use Service\AwareTrait;

    public function create(): SuccessInterface
    {
        $updateCompleteSuccess = $this->_getUpdateCompleteSuccess();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteSuccess->setJobStateService($stateService);

        return $updateCompleteSuccess;
    }
}