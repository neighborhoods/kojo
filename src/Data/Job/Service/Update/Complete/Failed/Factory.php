<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedInterface;
use NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Failed\AwareTrait;
    use Service\AwareTrait;

    public function create(): FailedInterface
    {
        $updateCompleteFailed = $this->_getUpdateCompleteFailed();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteFailed->setJobStateService($stateService);

        return $updateCompleteFailed;
    }
}