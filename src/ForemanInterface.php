<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Service\Update;
use NHDS\Jobs\Worker;

interface ForemanInterface
{
    public function workWorker(): ForemanInterface;

    public function setServiceUpdateWorkFactory(Update\Work\FactoryInterface $updateWorkFactory);

    public function setServiceUpdateCrashFactory(Update\Crash\FactoryInterface $updateCrashFactory);

    public function setWorkerJobService(Worker\Job\ServiceInterface $workerJobService);
}