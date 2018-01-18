<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Work;

use NHDS\Jobs\Data\Job\Service\Update\WorkInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Data\Job\Service\Update\Work;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Work\AwareTrait;
    use Service\AwareTrait;

    public function create(): WorkInterface
    {
        $updateWork = $this->_getJobServiceUpdateWorkClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateWork->setJobStateService($stateService);

        return $updateWork;
    }
}