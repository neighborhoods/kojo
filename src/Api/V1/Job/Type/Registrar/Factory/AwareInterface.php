<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar\Factory;

use Neighborhoods\Kojo\Api\V1\Job\Type\Registrar\FactoryInterface;

interface AwareInterface
{
    public function setApiV1JobTypeRegistrarFactory(FactoryInterface $apiV1JobTypeRegistrarFactory);
}
