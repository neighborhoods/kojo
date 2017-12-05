<?php

namespace NHDS\Jobs\Container\Builder;

use Symfony\Component\DependencyInjection\ContainerBuilder;

trait AwareTrait
{
    protected $_containerBuilder;

    public function setContainerBuilder(ContainerBuilder $containerBuilder)
    {
        if ($this->_containerBuilder === null) {
            $this->_containerBuilder = $containerBuilder;
        }else {
            throw new \LogicException('Container builder is already set.');
        }

        return $this;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->_containerBuilder === null) {
            throw new \LogicException('Container builder is not set.');
        }

        return $this->_containerBuilder;
    }
}