<?php
declare(strict_types=1);

namespace NHDS\Jobs\Type\Service\Create;

use NHDS\Jobs\Type\Service\CreateInterface;

trait AwareTrait
{
    public function setTypeServiceCreate(CreateInterface $create)
    {
        $this->_create(CreateInterface ::class, $create);

        return $this;
    }

    protected function _getTypeServiceCreate(): CreateInterface
    {
        return $this->_read(CreateInterface ::class);
    }

    protected function _getTypeServiceCreateClone(): CreateInterface
    {
        return clone $this->_getServiceCreate();
    }

    protected function _unsetTypeServiceCreate()
    {
        $this->_delete(CreateInterface::class);

        return $this;
    }
}