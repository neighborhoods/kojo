<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar;

use Neighborhoods\Kojo\Api\V1\Job\Type\RegistrarInterface;

trait AwareTrait
{
    public function setApiV1JobTypeRegistrar(RegistrarInterface $ApiV1JobTypeRegistrar): self
    {
        $this->_create(RegistrarInterface::class, $ApiV1JobTypeRegistrar);

        return $this;
    }

    protected function _getApiV1JobTypeRegistrar(): RegistrarInterface
    {
        return $this->_read(RegistrarInterface::class);
    }

    protected function _getApiV1JobTypeRegistrarClone(): RegistrarInterface
    {
        return clone $this->_getApiV1JobTypeRegistrar();
    }

    protected function _hasApiV1JobTypeRegistrar(): bool
    {
        return $this->_exists(RegistrarInterface::class);
    }

    protected function _unsetApiV1JobTypeRegistrar(): self
    {
        $this->_delete(RegistrarInterface::class);

        return $this;
    }
}