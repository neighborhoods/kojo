<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\RDBMS\Connection\Service;

use Neighborhoods\Kojo\Api\V1\RDBMS\Connection\ServiceInterface;

interface AwareInterface
{
    public function setApiV1RDBMSConnectionService(ServiceInterface $ApiV1RDBMSConnectionService): self;
}
