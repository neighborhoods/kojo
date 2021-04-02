<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar;

use Neighborhoods\Kojo\Api\V1\Job\Type\RegistrarInterface;

interface FactoryInterface extends AwareInterface
{
    public function create(): RegistrarInterface;
}
