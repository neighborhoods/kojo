<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Wait;

use NHDS\Jobs\Data\Job\Service\Update\WaitInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Data\Job\Service\Update\Wait;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Wait\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): WaitInterface
    {
        $updateWait = $this->_getJobServiceUpdateWaitClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateWait->setJobStateService($stateService);

        return $updateWait;
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