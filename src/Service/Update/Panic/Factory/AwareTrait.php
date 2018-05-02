<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic\Factory;

use Neighborhoods\Kojo\Service\Update\Panic\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdatePanicFactory(FactoryInterface $serviceUpdatePanicFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdatePanicFactory);

        return $this;
    }

    protected function _getServiceUpdatePanicFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdatePanicFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}