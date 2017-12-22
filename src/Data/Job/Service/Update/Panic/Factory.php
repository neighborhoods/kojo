<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Panic;

use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Crud;
use  NHDS\Jobs\Data\Job\Service\Update\Panic;
use NHDS\Jobs\Data\Job\Service\Update\PanicInterface;

class Factory implements FactoryInterface
{
    use Crud\AwareTrait;
    use Panic\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): PanicInterface
    {
        $updatePanic = $this->_getJobServiceUpdatePanicClone();
        $stateService = $this->_getJobStateServiceClone();
        $updatePanic->setJobStateService($stateService);

        return $updatePanic;
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