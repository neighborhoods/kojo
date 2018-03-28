<?php
declare(strict_types=1);

namespace NHDS\Jobs\Type\Service\Create;

use NHDS\Jobs\Api\V1\Type\Service\Create\FactoryInterface;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Type\Service\Create;
use NHDS\Jobs\Type\Service\CreateInterface;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Create\AwareTrait;

    public function create(): CreateInterface
    {
        $create = $this->_getTypeServiceCreateClone();

        return $create;
    }
}