<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Success;

use NHDS\Jobs\Data\Job\Service\Update\Complete\SuccessInterface;
use NHDS\Jobs\Data\Job\Service\Update\Complete\Success;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Success\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): SuccessInterface
    {
        $updateCompleteSuccess = $this->_getUpdateCompleteSuccess();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteSuccess->setJobStateService($stateService);

        return $updateCompleteSuccess;
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