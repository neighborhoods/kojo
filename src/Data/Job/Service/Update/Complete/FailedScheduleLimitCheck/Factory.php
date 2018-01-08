<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheckInterface;
use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Crud;

class Factory implements FactoryInterface
{
    use Crud\AwareTrait;
    use FailedScheduleLimitCheck\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): FailedScheduleLimitCheckInterface
    {
        $updateCompleteFailedScheduleLimitCheck = $this->_getUpdateCompleteFailedScheduleLimitCheckClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteFailedScheduleLimitCheck->setJobStateService($stateService);

        return $updateCompleteFailedScheduleLimitCheck;
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