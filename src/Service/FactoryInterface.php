<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service;

interface FactoryInterface
{
    public function setName(string $factoryName);

    public function getName(): string;

    public function create();
}