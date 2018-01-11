<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Retry;

use NHDS\Jobs\Data\Job\Service\Update\RetryInterface;
use NHDS\Jobs\Data\Job\Service\Update\Retry;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Retry\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): RetryInterface
    {
        $updateCompleteRetry = $this->_getUpdateRetry();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteRetry->setJobStateService($stateService);

        return $updateCompleteRetry;
    }

    public function setName(string $factoryName): FactoryInterface
    {
        $this->_create(self::PROP_FACTORY_NAME, $factoryName);

        return $this;
    }

    public function getName(): string
    {
        return $this->_read(self::PROP_FACTORY_NAME);
    }
}