<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Api\V1\RDBMS\Connection;
use Neighborhoods\Kojo\Api\V1\Worker;
use Neighborhoods\Kojo\Service\Update;

interface ForemanInterface extends Connection\Service\AwareInterface, Worker\Service\AwareInterface
{
    public function workWorker(): ForemanInterface;

    public function setServiceUpdateWorkFactory(Update\Work\FactoryInterface $updateWorkFactory);
}
