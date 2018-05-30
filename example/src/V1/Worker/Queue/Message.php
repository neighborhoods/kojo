<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

use Neighborhoods\KojoExample\V1;

class Message implements MessageInterface
{
    use V1\Guzzle\Service\Resource\Model\AwareTrait;
    use V1\Aws\Sqs\SqsClient\AwareTrait;
    protected $isDeleted = false;
    protected const SQS_CLIENT_QUEUE_URL = 'QueueUrl';
    protected const SQS_CLIENT_RECEIPT_HANDLE = 'ReceiptHandle';

    public function delete(): MessageInterface
    {
        if ($this->isDeleted !== false) {
            throw new \LogicException('Message is already deleted.');
        }
        $sqsClientReceiptHandle = $this->getV1GuzzleServiceResourceModel()->get(self::SQS_CLIENT_RECEIPT_HANDLE);
        $this->getV1AwsSqsSqsClient()->deleteMessage([
            self::SQS_CLIENT_QUEUE_URL => $this->getV1GuzzleServiceResourceModel()->get(self::SQS_CLIENT_QUEUE_URL),
            self::SQS_CLIENT_RECEIPT_HANDLE => $sqsClientReceiptHandle,
        ]);
        $this->isDeleted = true;

        return $this;
    }
}