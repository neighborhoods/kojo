<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker;

use Neighborhoods\KojoExample\Worker\Queue\MessageInterface;

interface DelegateInterface
{
    public function setWorkerQueueMessage(MessageInterface $workerQueueMessage);

    public function businessLogic(): DelegateInterface;
}