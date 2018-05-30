<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

use Aws\Sqs\SqsClient;
use Guzzle\Service\Resource\Model;

class Message implements MessageInterface
{
    protected $GuzzleServiceResourceModel;
    protected $sqsClient;
    protected $isDeleted = false;

    public function setGuzzleServiceResourceModel(Model $guzzleServiceResourceModel): MessageInterface
    {
        if ($this->GuzzleServiceResourceModel === null) {
            $this->GuzzleServiceResourceModel = $guzzleServiceResourceModel;
        }

        return $this;
    }

    protected function getGuzzleServiceResourceModel(): Model
    {
        if ($this->GuzzleServiceResourceModel === null) {
            throw new \LogicException('GuzzleServiceResourceModel is not set.');
        }

        return $this->GuzzleServiceResourceModel;
    }

    public function delete(): MessageInterface
    {
        if ($this->isDeleted !== false) {
            throw new \LogicException('Message is already deleted.');
        }
        $this->getSqsClient()->deleteMessage([
            'QueueUrl' => $this->getGuzzleServiceResourceModel()->get('QueueUrl'),
            'ReceiptHandle' => $this->getGuzzleServiceResourceModel()->get('ReceiptHandle'),
        ]);
        $this->isDeleted = true;

        return $this;
    }

    protected function getSqsClient(): SqsClient
    {
        if ($this->sqsClient === null) {
            $this->sqsClient = SqsClient::factory();
        }

        return $this->sqsClient;
    }
}