<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker;

use Neighborhoods\Kojo\Example\Worker;
use Neighborhoods\Kojo\Example\Worker\Queue\MessageInterface;

class Queue implements QueueInterface
{
    use Worker\Queue\Message\AwareTrait;

    public function getNextMessage(): MessageInterface
    {
        return $this->_getWorkerQueueMessageClone();
    }

    public function waitForNextMessage(): QueueInterface
    {
        sleep(random_int(0, 10));

        return $this;
    }

    public function hasNextMessage(): bool
    {
        return (random_int(0, 5) === 5);
    }
}