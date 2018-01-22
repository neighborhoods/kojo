<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Work;

use NHDS\Jobs\Service\Update\WorkInterface;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Service\Update\Work;

class Factory extends FactoryAbstract implements FactoryInterface
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