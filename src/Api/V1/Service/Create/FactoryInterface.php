<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Service\Create;

use Neighborhoods\Kojo\Data\Job\Collection\ScheduleLimitInterface;
use Neighborhoods\Kojo\Service\CreateInterface;
use Neighborhoods\Kojo\State\ServiceInterface;
use Neighborhoods\Kojo\Service;

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