<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Hold\Factory;

use Neighborhoods\Kojo\Service\Update\Hold\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateHoldFactory(FactoryInterface $serviceUpdateHoldFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateHoldFactory);

        return $this;
    }

    protected function _getServiceUpdateHoldFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateHoldFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}