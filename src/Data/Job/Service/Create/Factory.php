<?php

namespace NHDS\Jobs\Data\Job\Service\Create;

use NHDS\Jobs\Data\Job\Service\CreateInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Data\Job\Service\Create;
use NHDS\Jobs\Data\Job;

class Factory implements FactoryInterface
{
    use Crud\AwareTrait;
    use Create\AwareTrait;
    use Service\AwareTrait;
    use Job\Type\AwareTrait;
    use Job\AwareTrait;
    use Job\Collection\ScheduleLimit\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): CreateInterface
    {
        $create = $this->_getJobServiceCreateClone();
        $stateService = $this->_getJobStateServiceClone();
        $create->setJobStateService($stateService);
        $create->setJobCollectionScheduleLimit($this->_getJobCollectionScheduleLimitClone());
        $create->setJob($this->_getJobClone());
        $create->setJobType($this->_getJobTypeClone());

        return $create;
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