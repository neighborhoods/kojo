<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Work;

use NHDS\Jobs\Data\Job\Service\Update\WorkInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Data\Job\Service\Update\Work;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Work\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): WorkInterface
    {
        $updateWork = $this->_getJobServiceUpdateWorkClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateWork->setJobStateService($stateService);

        return $updateWork;
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