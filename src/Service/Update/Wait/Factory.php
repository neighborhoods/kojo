<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Wait;

use NHDS\Jobs\Service\Update\WaitInterface;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Service\Update\Wait;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Wait\AwareTrait;
    use Service\AwareTrait;

    public function create(): WaitInterface
    {
        $updateWait = $this->_getServiceUpdateWaitClone();
        $stateService = $this->_getStateServiceClone();
        $updateWait->setStateService($stateService);

        return $updateWait;
    }
}