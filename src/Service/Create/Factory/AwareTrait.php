<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create\Factory;

use Neighborhoods\Kojo\Service\Create\FactoryInterface;

trait AwareTrait
{
    /** @injected:runtime */
    public function setServiceCreateFactory(FactoryInterface $serviceCreateFactory): self
    {
        $this->_create(FactoryInterface::class, $serviceCreateFactory);

        return $this;
    }

    protected function _getServiceCreateFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasServiceCreateFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetServiceCreateFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}