<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker;

use Neighborhoods\Kojo\Example\Worker\Queue\MessageInterface;

interface DelegateInterface
{
    public function setWorkerQueueMessage(MessageInterface $workerQueueMessage);

    public function businessLogic(): DelegateInterface;
}