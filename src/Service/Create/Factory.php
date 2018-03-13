<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Create;

use NHDS\Jobs\Api\Service\Create\FactoryInterface;
use NHDS\Jobs\Api\Service\CreateInterface;
use NHDS\Jobs\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Service\Create;
use NHDS\Jobs\Data\Job;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Create\AwareTrait;
    use Service\AwareTrait;
    use Job\Type\AwareTrait;
    use Job\AwareTrait;
    use Job\Collection\ScheduleLimit\AwareTrait;

    public function create(): CreateInterface
    {
        $create = $this->_getServiceCreateClone();
        $stateService = $this->_getStateServiceClone();
        $create->setStateService($stateService);
        $create->setJobCollectionScheduleLimit($this->_getJobCollectionScheduleLimitClone());
        $create->setJob($this->_getJobClone());

        return $create;
    }
}