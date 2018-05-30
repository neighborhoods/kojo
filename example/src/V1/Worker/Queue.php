<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker;

use Guzzle\Service\Resource\Model;
use Neighborhoods\KojoExample\V1;
use Neighborhoods\KojoExample\V1\Worker\Queue\MessageInterface;

class Queue implements QueueInterface
{
    use V1\Worker\Queue\Message\Factory\AwareTrait;
    use V1\Worker\Queue\Message\AwareTrait;
    use V1\Aws\Sqs\SqsClient\AwareTrait;

    protected $queueUrl;

    protected const QUEUE_URL = 'QueueUrl';
    protected const MESSAGES = 'Messages';

    public function getNextMessage(): MessageInterface
    {
        return $this->getV1WorkerQueueMessage();
    }

    public function waitForNextMessage(): QueueInterface
    {
        $this->unsetV1WorkerQueueMessage();
        $guzzleServiceResourceModel = $this->receiveMessage();
        while ($guzzleServiceResourceModel->get(self::MESSAGES) === null) {
            $guzzleServiceResourceModel = $this->receiveMessage();
        }
        $this->createNextMessage($guzzleServiceResourceModel);

        return $this;
    }

    public function hasNextMessage(): bool
    {
        if (!$this->hasV1WorkerQueueMessage()) {
            $guzzleServiceResourceModel = $this->receiveMessage();
            if ($guzzleServiceResourceModel->get(self::MESSAGES) !== null) {
                $this->createNextMessage($guzzleServiceResourceModel);
            }
        }

        return $this->hasV1WorkerQueueMessage();
    }

    protected function createNextMessage(Model $guzzleServiceResourceModel): QueueInterface
    {
        $v1WorkerQueueMessage = $this->getV1WorkerQueueMessageFactory()->create();
        $v1WorkerQueueMessage->setV1GuzzleServiceResourceModel($guzzleServiceResourceModel);
        $this->setV1WorkerQueueMessage($v1WorkerQueueMessage);

        return $this;
    }

    protected function receiveMessage(): Model
    {
        return $this->getV1AwsSqsSqsClient()->receiveMessage([self::QUEUE_URL => $this->getQueueUrl()]);
    }

    public function setQueueUrl(string $queueUrl): QueueInterface
    {
        if ($this->queueUrl === null) {
            $this->queueUrl = $queueUrl;
        } else {
            throw new \LogicException('Queue URL is already set.');
        }

        return $this;
    }

    protected function getQueueUrl(): string
    {
        if ($this->queueUrl === null) {
            throw new \LogicException('Queue URL is not set.');
        }

        return $this->queueUrl;
    }
}