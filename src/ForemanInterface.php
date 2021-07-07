<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;

interface ForemanInterface
{
    public function workWorker(): ForemanInterface;

    public function setServiceUpdateWorkFactory(Update\Work\FactoryInterface $updateWorkFactory);

    public function setApiV1WorkerService(ServiceInterface $workerService);
}
