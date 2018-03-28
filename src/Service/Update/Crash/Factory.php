<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash;

use Neighborhoods\Kojo\Service\Update\CrashInterface;
use Neighborhoods\Kojo\State\Service;
use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Service\Update\Crash;

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