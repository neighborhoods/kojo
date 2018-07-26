<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Wait;

use Neighborhoods\Kojo\Service\Update\WaitInterface;
use Neighborhoods\Kojo\State\Service;
use Neighborhoods\Kojo\Service\Update\Wait;

class Factory implements FactoryInterface
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