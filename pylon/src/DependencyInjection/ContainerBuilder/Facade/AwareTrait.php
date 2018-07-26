<?php
declare(strict_types=1);

namespace Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\Facade;

use Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\FacadeInterface;

trait AwareTrait
{
    public function setDependencyInjectionContainerBuilderFacade(
        FacadeInterface $dependencyInjectionContainerBuilderFacade
    ): self{
        $this->_create(FacadeInterface::class, $dependencyInjectionContainerBuilderFacade);

        return $this;
    }

    protected function _getDependencyInjectionContainerBuilderFacade(): FacadeInterface
    {
        return $this->_read(FacadeInterface::class);
    }

    protected function _getDependencyInjectionContainerBuilderFacadeClone(): FacadeInterface
    {
        return clone $this->_getDependencyInjectionContainerBuilderFacade();
    }

    protected function _hasDependencyInjectionContainerBuilderFacade(): bool
    {
        return $this->_exists(FacadeInterface::class);
    }

    protected function _unsetDependencyInjectionContainerBuilderFacade(): self
    {
        $this->_delete(FacadeInterface::class);

        return $this;
    }
}