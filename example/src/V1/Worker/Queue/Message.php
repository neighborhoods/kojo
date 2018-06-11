<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

use Neighborhoods\KojoExample\V1;

class Message implements MessageInterface
{
    use V1\Guzzle\Service\Resource\Model\AwareTrait;
    use V1\Aws\Sqs\SqsClient\AwareTrait;
    protected $isDeleted = false;
    protected $queueUrl;

    protected const SQS_CLIENT_QUEUE_URL = 'QueueUrl';
    protected const SQS_CLIENT_RECEIPT_HANDLE = 'ReceiptHandle';

    public function delete(): MessageInterface
    {
        if ($this->isDeleted !== false) {
            throw new \LogicException('Message is already deleted.');
        }
        $messages = $this->getV1GuzzleServiceResourceModel()->get('Messages');
        $receiptHandle = $messages[0][self::SQS_CLIENT_RECEIPT_HANDLE];
        $this->getV1AwsSqsSqsClient()->deleteMessage([
            self::SQS_CLIENT_QUEUE_URL => $this->getQueueUrl(),
            self::SQS_CLIENT_RECEIPT_HANDLE => $receiptHandle,
        ]);
        $this->isDeleted = true;

        return $this;
    }

    protected function getQueueUrl()
    {
        if ($this->queueUrl === null) {
            throw new \LogicException('Queue URL has not been set.');
        }

        return $this->queueUrl;
    }

    public function setQueueUrl($queueUrl): MessageInterface
    {
        if ($this->queueUrl !== null) {
            throw new \LogicException('Queue URL already set.');
        }
        $this->queueUrl = $queueUrl;

        return $this;
    }
}