<?php
declare(strict_types=1);

namespace NHDS\Watch\TestCase\ContainerBuilder;

use NHDS\Toolkit;
use ReflectionClass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

trait AwareTrait
{
    use Toolkit\ContainerBuilder\AwareTrait;

    protected function _getTestContainerBuilder(): ContainerBuilder
    {
        if (!$this->_exists('test_container_builder')) {
            $reflectionClass = new ReflectionClass($this);
            $testClassFilePath = $reflectionClass->getFileName();
            $testClassDirectoryPath = dirname($testClassFilePath);
            $shortName = $reflectionClass->getShortName();
            $testServicesYamlFilePath = $testClassDirectoryPath . '/config/' . $shortName . '.yml';
            $testContainerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($testContainerBuilder, new FileLocator(__DIR__));
            $loader->load($testServicesYamlFilePath);
            $passes = [new AnalyzeServiceReferencesPass(), new InlineServiceDefinitionsPass()];
            $repeatedPass = new RepeatedPass($passes);
            $repeatedPass->process($testContainerBuilder);
            $testContainerBuilder->set('test_container_builder', $testContainerBuilder);
            $this->_create('test_container_builder', $testContainerBuilder);
        }

        return $this->_read('test_container_builder');
    }
}