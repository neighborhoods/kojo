<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar\Factory;

use Neighborhoods\Kojo\Api\V1\Job\Type\Registrar\FactoryInterface;

trait AwareTrait
{
    public function setApiV1JobTypeRegistrarFactory(FactoryInterface $apiV1JobTypeRegistrarFactory): self
    {
        $this->_create(FactoryInterface::class, $apiV1JobTypeRegistrarFactory);

        return $this;
    }

    protected function _getApiV1JobTypeRegistrarFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getApiV1JobTypeRegistrarFactoryClone(): FactoryInterface
    {
        return clone $this->_getApiV1JobTypeRegistrarFactory();
    }

    protected function _hasApiV1JobTypeRegistrarFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetApiV1JobTypeRegistrarFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}