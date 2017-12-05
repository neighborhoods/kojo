<?php

namespace NHDS\Jobs\Test\Unit\Fixture;

use PHPUnit\DbUnit\DataSet\YamlDataSet;
use PHPUnit\DbUnit\TestCase;
use NHDS\Jobs\Container;
use NHDS\Jobs\Data\Property\Crud;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AbstractTest extends TestCase
{
    use Crud\AwareTrait;
    const PROP_CONTAINER_BUILDER = 'container_builder';

    /**
     * @expectedException
     */
    public function setUp()
    {
        $tearDown = $this->_getTestContainerBuilder()->get('tear_down');
        $tearDown->uninstall();
        $setup = $this->_getTestContainerBuilder()->get('setup');
        $setup->install();

        parent::setUp();
    }

    protected function getConnection()
    {
        $pdo = $this->_getTestContainerBuilder()->get('pdo');

        return $this->createDefaultDBConnection($pdo);
    }

    protected function getDataSet()
    {
        $yamlDataSet = new YamlDataSet(__DIR__ . DIRECTORY_SEPARATOR);
        $yamlDataSet->addYamlFile(__DIR__ . DIRECTORY_SEPARATOR);

        return $yamlDataSet;
    }

    protected function _getTestContainerBuilder(): ContainerBuilder
    {
        if (!$this->_exists(self::PROP_CONTAINER_BUILDER)) {
            $container = new Container();
            $container->setServicesYamlFilePath(__DIR__ . DIRECTORY_SEPARATOR);
            $this->_create(self::PROP_CONTAINER_BUILDER, $container->getContainerBuilder());
        }

        return $this->_read(self::PROP_CONTAINER_BUILDER);
    }
}