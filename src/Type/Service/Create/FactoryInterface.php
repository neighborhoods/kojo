<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service\Create;

use Neighborhoods\Kojo\Type\Service\CreateInterface;

interface FactoryInterface
{
    public function create(): CreateInterface;
}