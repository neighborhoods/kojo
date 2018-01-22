<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\Failed;

use NHDS\Jobs\Service\Update\Complete\FailedInterface;
use NHDS\Jobs\Service\Update\Complete\Failed;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Failed\AwareTrait;
    use Service\AwareTrait;

    public function create(): FailedInterface
    {
        $updateCompleteFailed = $this->_getServiceUpdateCompleteFailed();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteFailed->setStateService($stateService);

        return $updateCompleteFailed;
    }
}