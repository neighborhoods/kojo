<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Hold;

use NHDS\Jobs\Service\Update\HoldInterface;
use NHDS\Jobs\Service\Update\Hold;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Hold\AwareTrait;
    use Service\AwareTrait;

    public function create(): HoldInterface
    {
        $updateCompleteHold = $this->_getServiceUpdateHold();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteHold->setStateService($stateService);

        return $updateCompleteHold;
    }
}