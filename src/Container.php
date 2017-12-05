<?php

namespace NHDS\Jobs;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Container
{
    protected $_servicesYamlFilePath;
    protected $_containerBuilder;

    public function setServicesYamlFilePath(string $servicesYamlFilePath): Container
    {
        if ($this->_servicesYamlFilePath === null) {
            $this->_servicesYamlFilePath = $servicesYamlFilePath;
        }else {

            throw new \LogicException('Services yaml file path is already set.');
        }

        return $this;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->_containerBuilder === null) {
            $containerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
            $loader->load($this->_getServicesYamlFilePath());
            $containerBuilder->set('container_builder', $containerBuilder);
            $this->_containerBuilder = $containerBuilder;
        }

        return $this->_containerBuilder;
    }

    protected function _getServicesYamlFilePath(): string
    {
        if ($this->_servicesYamlFilePath === null) {
            $this->_servicesYamlFilePath = 'config/root.yml';
        }

        return $this->_servicesYamlFilePath;
    }
}