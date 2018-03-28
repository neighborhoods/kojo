<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work\Factory;

use Neighborhoods\Kojo\Service\Update\Work\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateWorkFactory(FactoryInterface $serviceUpdateWorkFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateWorkFactory);

        return $this;
    }

    protected function _getServiceUpdateWorkFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateWorkFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}