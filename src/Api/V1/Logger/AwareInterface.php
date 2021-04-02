<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Logger;

use Neighborhoods\Kojo\Api\V1\LoggerInterface;

interface AwareInterface
{
    public function setApiV1Logger(LoggerInterface $apiV1Logger);
}
