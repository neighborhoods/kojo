<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Retry;

use Neighborhoods\Kojo\Service\Update\RetryInterface;
use Neighborhoods\Kojo\Service\Update\Retry;
use Neighborhoods\Kojo\State\Service;

class Factory implements FactoryInterface
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