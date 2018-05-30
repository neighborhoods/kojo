<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker;

use Aws\Sqs\SqsClient;
use Guzzle\Service\Resource\Model;
use Neighborhoods\KojoExample\V1\Worker;
use Neighborhoods\KojoExample\V1\Worker\Queue\MessageInterface;

class Queue implements QueueInterface
{
    use Worker\Queue\Message\Factory\AwareTrait;
    use Worker\Queue\Message\AwareTrait;

    protected $sqsClient;

    public function getNextMessage(): MessageInterface
    {
        return $this->getV1WorkerQueueMessage();
    }

    public function waitForNextMessage(): QueueInterface
    {
        $this->unsetV1WorkerQueueMessage();
        $guzzleServiceResourceModel = $this->getSqsClient()->receiveMessage();
        while (empty($guzzleServiceResourceModel)) {
            $guzzleServiceResourceModel = $this->getSqsClient()->receiveMessage();
        }
        $this->createNextMessage($guzzleServiceResourceModel);

        return $this;
    }

    public function hasNextMessage(): bool
    {
        if (!$this->hasV1WorkerQueueMessage()) {
            if (!empty($guzzleServiceResourceModel = $this->getSqsClient()->receiveMessage())) {
                $this->createNextMessage($guzzleServiceResourceModel);
            }
        }

        return $this->hasV1WorkerQueueMessage();
    }

    protected function getSqsClient(): SqsClient
    {
        if ($this->sqsClient === null) {
            $this->sqsClient = SqsClient::factory();
        }

        return $this->sqsClient;
    }

    protected function createNextMessage(Model $guzzleServiceResourceModel): QueueInterface
    {
        $v1WorkerQueueMessage = $this->getV1WorkerQueueMessageFactory()->create();
        $v1WorkerQueueMessage->setGuzzleServiceResourceModel($guzzleServiceResourceModel);
        $this->setV1WorkerQueueMessage($v1WorkerQueueMessage);

        return $this;
    }
}