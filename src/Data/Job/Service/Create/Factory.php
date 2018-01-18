<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Create;

use NHDS\Jobs\Data\Job\Service\CreateInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Data\Job\Service\Create;
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
        $create = $this->_getJobServiceCreateClone();
        $stateService = $this->_getJobStateServiceClone();
        $create->setJobStateService($stateService);
        $create->setJobCollectionScheduleLimit($this->_getJobCollectionScheduleLimitClone());
        $create->setJob($this->_getJobClone());

        return $create;
    }
}