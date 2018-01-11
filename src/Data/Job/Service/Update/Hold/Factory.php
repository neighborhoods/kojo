<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Hold;

use NHDS\Jobs\Data\Job\Service\Update\HoldInterface;
use NHDS\Jobs\Data\Job\Service\Update\Hold;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Hold\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): HoldInterface
    {
        $updateCompleteHold = $this->_getUpdateHold();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteHold->setJobStateService($stateService);

        return $updateCompleteHold;
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