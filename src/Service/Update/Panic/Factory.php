<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Panic;

use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Service\Update\Panic;
use NHDS\Jobs\Service\Update\PanicInterface;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Panic\AwareTrait;
    use Service\AwareTrait;

    public function create(): PanicInterface
    {
        $updatePanic = $this->_getServiceUpdatePanicClone();
        $stateService = $this->_getStateServiceClone();
        $updatePanic->setStateService($stateService);

        return $updatePanic;
    }
}