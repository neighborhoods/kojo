<?php

namespace NHDS\Jobs\Test\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use NHDS\Jobs\Container;
use NHDS\Jobs\Data\Property\Crud;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractTest extends TestCase
{
    use Crud\AwareTrait;
    const PROP_CONTAINER_BUILDER = 'container_builder';

    protected function _getTestContainerBuilder(): ContainerBuilder
    {
        if (!$this->_exists(self::PROP_CONTAINER_BUILDER)) {
            $classFqn = static::class;
            $reflector = new ReflectionClass($classFqn);
            $testClassFilePath = $reflector->getFileName();
            $testClassDirectoryPath = dirname($testClassFilePath);
            $className = array_pop(explode('\\', static::class));
            $servicesYamlFilePath = $testClassDirectoryPath . '/config/' . $className . '.yml';
            $container = new Container();
            $container->setServicesYamlFilePath($servicesYamlFilePath);
            $this->_create(self::PROP_CONTAINER_BUILDER, $container->getContainerBuilder());
        }

        return $this->_read(self::PROP_CONTAINER_BUILDER);
    }
}