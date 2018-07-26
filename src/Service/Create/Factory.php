<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create;

use Neighborhoods\Kojo\Service\CreateInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Service;
use Neighborhoods\Kojo;

class Factory implements FactoryInterface
{
    use Service\Create\AwareTrait;
    use Kojo\Job\Type\AwareTrait;
    use Kojo\Job\AwareTrait;
    use Kojo\Job\Collection\ScheduleLimit\AwareTrait;
    use State\Service\Factory\AwareTrait;

    public function create(): CreateInterface
    {
        $create = clone $this->getServiceCreate();
        $stateService = clone $this->getStateServiceFactory()->create();
        $create->setStateService($stateService);
        $create->setJobCollectionScheduleLimit($this->_getJobCollectionScheduleLimitClone());
        $create->setJob($this->_getJobClone());

        return $create;
    }
}