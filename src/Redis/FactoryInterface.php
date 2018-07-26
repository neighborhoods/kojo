<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

interface FactoryInterface
{
    public const PROP_HOST = 'host';
    public const PROP_PORT = 'port';

    public function create(): \Redis;

    public function setPort(int $port): FactoryInterface;

    public function setHost(string $host): FactoryInterface;

    public function addOption(int $optionName, string $optionValue): FactoryInterface;
}