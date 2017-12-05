<?php

namespace NHDS\Jobs\Test\Unit\ContainerBuilder;

use NHDS\Jobs\Container;
use ReflectionClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

trait AwareTrait
{
    protected function _getTestContainerBuilder(): ContainerBuilder
    {
        if (!$this->_exists(ContainerBuilder::class)) {
            $reflectionClass = new ReflectionClass($this);
            $testClassFilePath = $reflectionClass->getFileName();
            $testClassDirectoryPath = dirname($testClassFilePath);
            $shortName = $reflectionClass->getShortName();
            $testServicesYamlFilePath = $testClassDirectoryPath . '/config/' . $shortName . '.yml';
            $container = new Container();
            $container->setServicesYamlFilePath($testServicesYamlFilePath);
            $this->_create(ContainerBuilder::class, $container->getContainerBuilder());
        }

        return $this->_read(ContainerBuilder::class);
    }
}