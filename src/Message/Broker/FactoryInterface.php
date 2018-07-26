<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BrokerInterface;
}
