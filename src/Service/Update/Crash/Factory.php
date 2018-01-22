<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Crash;

use NHDS\Jobs\Service\Update\CrashInterface;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Service\Update\Crash;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Crash\AwareTrait;
    use Service\AwareTrait;

    public function create(): CrashInterface
    {
        $updateCrash = $this->_getServiceUpdateCrashClone();
        $stateService = $this->_getStateServiceClone();
        $updateCrash->setStateService($stateService);

        return $updateCrash;
    }
}