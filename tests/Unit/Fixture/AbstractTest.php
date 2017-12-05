<?php

namespace NHDS\Jobs\Test\Unit\Fixture;

use PHPUnit\DbUnit\DataSet\YamlDataSet;
use PHPUnit\DbUnit;
use NHDS\Jobs\Data\Property\Crud;
use \NHDS\Jobs\Test\Unit\ContainerBuilder;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class AbstractTest extends DbUnit\TestCase
{
    use Crud\AwareTrait;
    use ContainerBuilder\AwareTrait;
    const PROP_DATA_SET = 'data_set';

    /**  @expectedException */
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
        $reflectionClass = new ReflectionClass($this);

        $testClassFilePath = $reflectionClass->getFileName();
        $testClassDirectoryPath = dirname($testClassFilePath);
        $className = $reflectionClass->getShortName();
        $fixturesDiurectoryPath = $testClassDirectoryPath . '/fixtures/' . $className;
        $finder = new Finder();
        $finder->files()->in($fixturesDiurectoryPath);
        $finder->sortByName();
        foreach ($finder as $filePath => $file) {
            $this->_addFilePathToYamlDataSet($filePath);
        }

        return $this->_getYamlDataSet();
    }

    protected function _addFilePathToYamlDataSet(string $yamlDataSetFilePath): AbstractTest
    {
        if (!$this->_exists(YamlDataSet::class)) {
            $this->_create(YamlDataSet::class, new YamlDataSet($yamlDataSetFilePath));
        }else {
            $this->_getYamlDataSet()->addYamlFile($yamlDataSetFilePath);
        }

        return $this;
    }

    protected function _getYamlDataSet(): YamlDataSet
    {
        return $this->_read(YamlDataSet::class);
    }
}