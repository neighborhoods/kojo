<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service\Create;

use Neighborhoods\Kojo\Service;
use Neighborhoods\Kojo\Type\Service\CreateInterface;

interface FactoryInterface extends Service\FactoryInterface
{
    public function create(): CreateInterface;
}