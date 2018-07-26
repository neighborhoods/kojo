<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger\Message;

use Neighborhoods\Kojo\Logger\MessageInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : MessageInterface;
}
