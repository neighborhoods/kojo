<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar;

use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Api\V1\Job\Type\RegistrarInterface;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use AwareTrait;

    public function create(): RegistrarInterface
    {
        $apiV1JobTypeRegistrar = $this->_getApiV1JobTypeRegistrarClone();

        return $apiV1JobTypeRegistrar;
    }
}