<?php
declare(strict_types=1);

namespace NHDS\Jobs\Redis;

use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    const PROP_HOST = 'host';
    const PROP_PORT = 'port';

    public function create(): \Redis;

    public function setPort(int $port): FactoryInterface;

    public function setHost(string $host): FactoryInterface;

    public function addOption(int $optionName, string $optionValue): FactoryInterface;
}