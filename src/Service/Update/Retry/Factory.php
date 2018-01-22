<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Retry;

use NHDS\Jobs\Service\Update\RetryInterface;
use NHDS\Jobs\Service\Update\Retry;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Retry\AwareTrait;
    use Service\AwareTrait;

    public function create(): RetryInterface
    {
        $updateCompleteRetry = $this->_getServiceUpdateRetry();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteRetry->setStateService($stateService);

        return $updateCompleteRetry;
    }
}