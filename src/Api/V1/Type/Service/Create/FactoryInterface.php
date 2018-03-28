<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\V1\Type\Service\Create;

use NHDS\Jobs\Service;
use NHDS\Jobs\Type\Service\CreateInterface;

interface FactoryInterface extends Service\FactoryInterface
{
    public function create(): CreateInterface;
}