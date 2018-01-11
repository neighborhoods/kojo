<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Crash;

use NHDS\Jobs\Data\Job\Service\Update\CrashInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Data\Job\Service\Update\Crash;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Crash\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): CrashInterface
    {
        $updateCrash = $this->_getJobServiceUpdateCrashClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateCrash->setJobStateService($stateService);

        return $updateCrash;
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