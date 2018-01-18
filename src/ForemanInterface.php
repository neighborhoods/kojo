<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job\Service\Update;
use NHDS\Jobs\Worker;

interface ForemanInterface
{
    public function work(): ForemanInterface;

    public function setJobServiceUpdateWorkFactory(Update\Work\FactoryInterface $updateWorkFactory);

    public function setJobServiceUpdateCrashFactory(Update\Crash\FactoryInterface $updateCrashFactory);

    public function setWorkerJobService(Worker\Job\ServiceInterface $workerJobService);
}