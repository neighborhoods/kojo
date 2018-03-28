<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding\Fixture;

use Neighborhoods\Scaffolding\PHPUnit\DbUnit\DataSet\SymfonyYamlParser;
use PHPUnit\DbUnit;
use ReflectionClass;
use Neighborhoods\Scaffolding\TestCase\ContainerBuilder;
use Neighborhoods\Toolkit\TimeInterface;
use PHPUnit\DbUnit\DataSet\DefaultTable;
use PHPUnit\DbUnit\DataSet\DefaultTableIterator;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use Neighborhoods\Toolkit\Data\Property\Strict;
use Symfony\Component\Finder\Finder;
use Neighborhoods\Scaffolding\TestCase\Service;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Yaml\Tag\TaggedValue;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractTest extends DbUnit\TestCase
{
    use ContainerBuilder\AwareTrait;
    use Service\AwareTrait;
    use Strict\AwareTrait;
    const YML_SIGIL_PREFIX_FIXTURE_EXPRESSION = 'fixture/expression:';
    const PROP_DATA_SET                       = 'data_set';
    const PROP_EXPRESSION_VALUES              = 'expression_values';

    /**  @expectedException */
    public function setUp()
    {
        $ymlServiceFilePath = dirname(dirname(__FILE__)) . '/config/root.yml';
        $this->addServicesYmlFilePath($ymlServiceFilePath);
        $testCaseService = $this->getContainerBuilder()->get('nhds.watch.testcase.service');
        $this->setTestCaseService($testCaseService);
        $tearDown = $this->_getTestContainerBuilder()->get('db.tear_down');
        $tearDown->uninstall();
        $setup = $this->_getTestContainerBuilder()->get('db.setup');
        $setup->install();
        $redis = $this->_getTestContainerBuilder()->get('redis');
        $redis->flushAll();

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
            $this->_addFilePathToYmlDataSet($filePath);
        }

        return $this->_getEvaluatedYmlDataSet();
    }

    protected function _addFilePathToYmlDataSet(string $ymlDataSetFilePath): AbstractTest
    {
        if (!$this->_exists(YamlDataSet::class)) {
            $ymlParser = new SymfonyYamlParser();
            $ymlParser->setFlags(Yaml::PARSE_CUSTOM_TAGS);
            $this->_create(YamlDataSet::class, new YamlDataSet($ymlDataSetFilePath, $ymlParser));
        }else {
            $this->_getYmlDataSet()->addYamlFile($ymlDataSetFilePath);
        }

        return $this;
    }

    protected function _getEvaluatedYmlDataSet(): YamlDataSet
    {
        /** @var DefaultTableIterator $tableIterator */
        $tableIterator = $this->_getYmlDataSet()->getIterator();
        $expressionLanguage = new ExpressionLanguage();
        $expressionValues = &$this->_getTestCaseService()->getExpressionValues();
        /** @var  DefaultTable $table */
        foreach ($tableIterator as $table) {
            $rowCount = $table->getRowCount();
            while (--$rowCount >= 0) {
                $row = $table->getRow($rowCount);
                foreach ($row as $columnName => $columnValue) {
                    if ($columnValue instanceof TaggedValue) {
                        if ($columnValue->getTag() === self::YML_SIGIL_PREFIX_FIXTURE_EXPRESSION) {
                            $expression = $columnValue->getValue();
                            $expressedValue = $expressionLanguage->evaluate($expression, $expressionValues);
                            $table->setValue($rowCount, $columnName, $expressedValue);
                        }
                    }
                }
            }
        }

        return $this->_getYmlDataSet();
    }

    protected function _getYmlDataSet(): YamlDataSet
    {
        return $this->_read(YamlDataSet::class);
    }

    protected function _getTime(): TimeInterface
    {
        return $this->_getTestContainerBuilder()->get('nhds.toolkit.time');
    }
}