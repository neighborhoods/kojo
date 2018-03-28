<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Worker;

interface ForemanInterface
{
    public function workWorker(): ForemanInterface;

    public function setServiceUpdateWorkFactory(Update\Work\FactoryInterface $updateWorkFactory);

    public function setServiceUpdateCrashFactory(Update\Crash\FactoryInterface $updateCrashFactory);

    public function setWorkerJobService(Worker\Job\ServiceInterface $workerJobService);
}