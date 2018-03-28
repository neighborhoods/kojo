<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Type\Service\Create;

use Neighborhoods\Kojo\Service;
use Neighborhoods\Kojo\Type\Service\CreateInterface;

interface FactoryInterface extends Service\FactoryInterface
{
    public function create(): CreateInterface;
}