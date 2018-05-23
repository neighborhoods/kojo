<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker;

use Neighborhoods\KojoExample\Worker\Queue\MessageInterface;

interface QueueInterface
{
    public function getNextMessage(): MessageInterface;

    public function hasNextMessage(): bool;

    public function waitForNextMessage(): QueueInterface;
}