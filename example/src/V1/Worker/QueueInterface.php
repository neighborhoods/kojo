<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker;

use Neighborhoods\KojoExample\V1\Worker\Queue\MessageInterface;

interface QueueInterface
{
    public function getNextMessage(): MessageInterface;

    public function hasNextMessage(): bool;

    public function waitForNextMessage(): QueueInterface;
}