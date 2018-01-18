<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Wait;

use NHDS\Jobs\Data\Job\Service\Update\WaitInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Data\Job\Service\Update\Wait;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Wait\AwareTrait;
    use Service\AwareTrait;

    public function create(): WaitInterface
    {
        $updateWait = $this->_getJobServiceUpdateWaitClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateWait->setJobStateService($stateService);

        return $updateWait;
    }
}