<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Worker\Service;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;

interface AwareInterface
{
    public function setApiV1WorkerService(ServiceInterface $apiV1WorkerService);
}
