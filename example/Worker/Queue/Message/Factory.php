<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Queue\Message;

use Neighborhoods\KojoExample\Worker\Queue\MessageInterface;
use Neighborhoods\Pylon\Data;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create(): MessageInterface
    {
        return clone $this->getWorkerQueueMessage();
    }
}
