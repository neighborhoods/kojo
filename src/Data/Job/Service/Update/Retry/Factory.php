<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Retry;

use NHDS\Jobs\Data\Job\Service\Update\RetryInterface;
use NHDS\Jobs\Data\Job\Service\Update\Retry;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Retry\AwareTrait;
    use Service\AwareTrait;

    public function create(): RetryInterface
    {
        $updateCompleteRetry = $this->_getUpdateRetry();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteRetry->setJobStateService($stateService);

        return $updateCompleteRetry;
    }
}