<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work;

use Neighborhoods\Kojo\Service\Update\WorkInterface;
use Neighborhoods\Kojo\State\Service;
use Neighborhoods\Kojo\Service\Update\Work;

class Factory implements FactoryInterface
{
    use Work\AwareTrait;
    use Service\AwareTrait;

    public function create(): WorkInterface
    {
        $updateWork = $this->_getServiceUpdateWorkClone();
        $stateService = $this->_getStateServiceClone();
        $updateWork->setStateService($stateService);

        return $updateWork;
    }
}