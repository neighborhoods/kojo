<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger\Message;

use Neighborhoods\Kojo\Logger\MessageInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : MessageInterface
    {
        return clone $this->getProcessPoolLoggerMessage();
    }
}
