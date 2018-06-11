<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;

interface WorkerInterface
{
    public function setApiV1WorkerService(ServiceInterface $apiV1WorkerService);

    public function work(): WorkerInterface;
}