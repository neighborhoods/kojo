<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\Service\Create;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;
use NHDS\Jobs\Service\CreateInterface;
use NHDS\Jobs\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    /** @injected:configuration */
    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit);

    /** @injected:configuration */
    public function setStateService(ServiceInterface $jobStateService);

    /** @injected:configuration */
    public function setServiceCreate(CreateInterface $jobServiceUpdateCrash);

    /** @injected:configuration */
    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): CreateInterface;
}