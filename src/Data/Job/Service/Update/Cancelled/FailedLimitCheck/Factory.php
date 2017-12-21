<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheckInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck;

class Factory implements FactoryInterface
{
    use Crud\AwareTrait;
    use FailedLimitCheck\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): FailedLimitCheckInterface
    {
        $updateCancelledFailedLimitCheck = $this->_getJobServiceUpdateCancelledFailedLimitCheckClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateCancelledFailedLimitCheck->setJobStateService($stateService);

        return $updateCancelledFailedLimitCheck;
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