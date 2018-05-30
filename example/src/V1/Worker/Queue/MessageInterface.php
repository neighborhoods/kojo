<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

use Guzzle\Service\Resource\Model;

interface MessageInterface
{

    public function setGuzzleServiceResourceModel(Model $guzzleServiceResourceModel): MessageInterface;

    public function delete(): MessageInterface;
}