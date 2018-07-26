<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use Neighborhoods\Kojo\Process\Pool\Logger\MessageInterface;
use Neighborhoods\Pylon\Data;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create() : MessageInterface
    {
        return clone $this->getProcessPoolLoggerMessage();
    }
}
