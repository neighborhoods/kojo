<?php

namespace NHDS\Watch\Fixture;

use PHPUnit\DbUnit;
use ReflectionClass;
use NHDS\Watch\TestCase\ContainerBuilder;
use NHDS\Toolkit\TimeInterface;
use PHPUnit\DbUnit\DataSet\DefaultTable;
use PHPUnit\DbUnit\DataSet\DefaultTableIterator;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use NHDS\Toolkit\Data\Property\Crud;
use Symfony\Component\Finder\Finder;
use NHDS\Watch\TestCase\Service;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

abstract class AbstractTest extends DbUnit\TestCase
{
    use ContainerBuilder\AwareTrait;
    use Service\AwareTrait;
    use Crud\AwareTrait;
    const YAML_SIGIL_PREFIX_FIXTURE_EXPRESSION = '!fixture/expression:';
    const PROP_DATA_SET                        = 'data_set';
    const PROP_EXPRESSION_VALUES               = 'expression_values';

    /**  @expectedException */
    public function setUp()
    {
        $yamlServiceFilePath = dirname(dirname(__FILE__)) . '/config/root.yml';
        $this->setServicesYamlFilePath($yamlServiceFilePath);
        $testCaseService = $this->getContainerBuilder()->get('nhds.watch.testcase.service');
        $this->setTestCaseService($testCaseService);
        $tearDown = $this->_getTestContainerBuilder()->get('nhds.jobs.db.teardown');
        $tearDown->uninstall();
        $setup = $this->_getTestContainerBuilder()->get('nhds.jobs.db.setup');
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
        $fixturesDirectoryPath = $testClassDirectoryPath . '/fixtures/' . $className;
        $finder = new Finder();
        $finder->files()->in($fixturesDirectoryPath);
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
        $expressionLanguage = new ExpressionLanguage();
        $expressionValues = &$this->_getTestCaseService()->getExpressionValues();
        /** @var  DefaultTable $table */
        foreach ($tableIterator as $table) {
            $rowCount = $table->getRowCount();
            while (--$rowCount >= 0) {
                $row = $table->getRow($rowCount);
                foreach ($row as $columnName => $value) {
                    if (is_string($value) && (0 === strpos($value, self::YAML_SIGIL_PREFIX_FIXTURE_EXPRESSION))) {
                        $expression = str_replace(self::YAML_SIGIL_PREFIX_FIXTURE_EXPRESSION, '', $value);
                        $expressedValue = $expressionLanguage->evaluate($expression, $expressionValues);
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
        return $this->_getTestContainerBuilder()->get('nhds.toolkit.time');
    }
}