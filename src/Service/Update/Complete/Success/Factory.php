<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\Success;

use NHDS\Jobs\Service\Update\Complete\SuccessInterface;
use NHDS\Jobs\Service\Update\Complete\Success;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Success\AwareTrait;
    use Service\AwareTrait;

    public function create(): SuccessInterface
    {
        $updateCompleteSuccess = $this->_getServiceUpdateCompleteSuccess();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteSuccess->setStateService($stateService);

        return $updateCompleteSuccess;
    }
}