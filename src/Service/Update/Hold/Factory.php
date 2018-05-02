<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Hold;

use Neighborhoods\Kojo\Service\Update\HoldInterface;
use Neighborhoods\Kojo\Service\Update\Hold;
use Neighborhoods\Kojo\State\Service;
use Neighborhoods\Kojo\Service\FactoryAbstract;

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