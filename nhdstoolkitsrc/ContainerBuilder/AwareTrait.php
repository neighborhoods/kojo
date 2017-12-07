<?php

namespace NHDS\Toolkit\ContainerBuilder;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;

trait AwareTrait
{
    protected $_servicesYamlFilePath;
    protected $_containerBuilder;

    public function setServicesYamlFilePath(string $servicesYamlFilePath)
    {
        if ($this->_servicesYamlFilePath === null) {
            $this->_servicesYamlFilePath = $servicesYamlFilePath;
        }else {

            throw new \LogicException('Services yaml file path is already set.');
        }

        return $this;
    }

    protected function _getServicesYamlFilePath(): string
    {
        if ($this->_servicesYamlFilePath === null) {
            throw new \LogicException('Services yaml file path is not set.');
        }

        return $this->_servicesYamlFilePath;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->_containerBuilder === null) {
            $containerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
            $loader->load($this->_getServicesYamlFilePath());
            $passes = [new AnalyzeServiceReferencesPass(), new InlineServiceDefinitionsPass()];
            $repeatedPass = new RepeatedPass($passes);
            $repeatedPass->process($containerBuilder);
            $containerBuilder->set('container_builder', $containerBuilder);
            $this->_containerBuilder = $containerBuilder;
        }

        return $this->_containerBuilder;
    }
}