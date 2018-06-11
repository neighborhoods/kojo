<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

use Guzzle\Service\Resource\Model;

interface MessageInterface
{
    public function setV1GuzzleServiceResourceModel(Model $guzzleServiceResourceModel);

    public function delete(): MessageInterface;

    public function setQueueUrl($queueUrl): MessageInterface;
}