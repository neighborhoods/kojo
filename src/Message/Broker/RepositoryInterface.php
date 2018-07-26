<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;

interface RepositoryInterface
{
    public const ID_CORE = 'core';
    public function get(string $id): BrokerInterface;
}