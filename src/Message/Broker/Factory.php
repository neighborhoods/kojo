<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BrokerInterface
    {
        return clone $this->getMessageBroker();
    }
}
