<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service\Create;

use Neighborhoods\Kojo\Api\V1\Type\Service\Create\FactoryInterface;
use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Type\Service\Create;
use Neighborhoods\Kojo\Type\Service\CreateInterface;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Create\AwareTrait;

    public function create(): CreateInterface
    {
        $create = $this->_getTypeServiceCreateClone();

        return $create;
    }
}