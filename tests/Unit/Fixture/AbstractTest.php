<?php

namespace NHDS\Jobs\Test\Unit\Fixture;

use NHDS\Jobs\TimeInterface;
use PHPUnit\DbUnit\DataSet\DefaultTable;
use PHPUnit\DbUnit\DataSet\DefaultTableIterator;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use PHPUnit\DbUnit;
use NHDS\Jobs\Data\Property\Crud;
use \NHDS\Jobs\Test\Unit\ContainerBuilder;
use ReflectionClass;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Finder\Finder;

class AbstractTest extends DbUnit\TestCase
{
    use Crud\AwareTrait;
    use ContainerBuilder\AwareTrait;
    const YAML_SIGIL_PREFIX_FIXTURE_EXPRESSION = '!fixture/expression:';
    const PROP_DATA_SET                        = 'data_set';

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

        return $this->_getEvaluatedYamlDataSet();
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

    protected function _getEvaluatedYamlDataSet(): YamlDataSet
    {
        /** @var DefaultTableIterator $tableIterator */
        $tableIterator = $this->_getYamlDataSet()->getIterator();
        $language = new ExpressionLanguage();
        /** @var  DefaultTable $table */
        foreach ($tableIterator as $table) {
            $rowCount = $table->getRowCount();
            while (--$rowCount >= 0) {
                $row = $table->getRow($rowCount);
                foreach ($row as $columnName => $value) {
                    if (is_string($value) && (0 === strpos($value, self::YAML_SIGIL_PREFIX_FIXTURE_EXPRESSION))) {
                        $expression = str_replace(self::YAML_SIGIL_PREFIX_FIXTURE_EXPRESSION, '', $value);
                        $expressedValue = $language->evaluate($expression, ['time' => $this->_getTime()]);
                        $table->setValue($rowCount, $columnName, $expressedValue);
                    }
                }
            }
        }

        return $this->_getYamlDataSet();
    }

    protected function _getYamlDataSet(): YamlDataSet
    {
        return $this->_read(YamlDataSet::class);
    }

    protected function _getTime(): TimeInterface
    {
        return $this->_getTestContainerBuilder()->get('time');
    }
}