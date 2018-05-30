<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue\Message;

use Neighborhoods\KojoExample\V1\Worker\Queue\MessageInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MessageInterface;
}
