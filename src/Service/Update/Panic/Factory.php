<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic;

use Neighborhoods\Kojo\State\Service;
use Neighborhoods\Kojo\Service\Update\Panic;
use Neighborhoods\Kojo\Service\Update\PanicInterface;

class Factory implements FactoryInterface
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