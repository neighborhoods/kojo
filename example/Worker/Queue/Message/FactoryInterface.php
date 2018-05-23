<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Queue\Message;

use Neighborhoods\KojoExample\Worker\Queue\MessageInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MessageInterface;
}
