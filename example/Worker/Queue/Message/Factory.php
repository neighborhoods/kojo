<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Queue\Message;

use Neighborhoods\Kojo\Example\Worker\Queue\MessageInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MessageInterface
    {
        $workerQueueMessage = $this->_getWorkerQueueMessageClone();

        return $workerQueueMessage;
    }
}