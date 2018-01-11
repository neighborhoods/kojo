<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedInterface;
use NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Toolkit\Data\Property\Strict;

class Factory implements FactoryInterface
{
    use Strict\AwareTrait;
    use Failed\AwareTrait;
    use Service\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): FailedInterface
    {
        $updateCompleteFailed = $this->_getUpdateCompleteFailed();
        $stateService = $this->_getJobStateServiceClone();
        $updateCompleteFailed->setJobStateService($stateService);

        return $updateCompleteFailed;
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