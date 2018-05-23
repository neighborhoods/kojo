<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker;

use Neighborhoods\KojoExample\Worker;
use Neighborhoods\KojoExample\Worker\Queue\MessageInterface;

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