<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler;

use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Api;
use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;
use Neighborhoods\Kojo\Service;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Api\V1\Job\Scheduler\AwareTrait;
    use Service\Create\Factory\AwareTrait;

    public function create(): SchedulerInterface
    {
        $apiV1JobScheduler = $this->_getApiV1JobSchedulerClone();
        $apiV1JobScheduler->setServiceCreate($this->_getServiceCreateFactory()->create());

        return $apiV1JobScheduler;
    }
}