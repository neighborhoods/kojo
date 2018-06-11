<?php
declare(strict_types=1);

ini_set('assert.exception', '1');
error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

$client = \Aws\Sqs\SqsClient::factory(
    ['region' => 'us-east-1']
);

$totalNumberOfMessagesToSend = 12000;
$messageCount = 0;
while ($messageCount !== $totalNumberOfMessagesToSend) {
    $client->sendMessage(array(
        'QueueUrl' => 'https://sqs.us-east-1.amazonaws.com/272157948465/local-bwilson',
        'MessageBody' => 'MESSAGE BODY',
    ));

    ++$messageCount;
}

return;