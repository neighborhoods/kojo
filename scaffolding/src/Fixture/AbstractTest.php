<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding\Fixture;

use Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\Facade;
use Neighborhoods\Scaffolding\Bootstrap;
use Neighborhoods\Scaffolding\PHPUnit\DbUnit\DataSet\SymfonyYamlParser;
use PHPUnit\DbUnit;
use ReflectionClass;
use Neighborhoods\Pylon\TimeInterface;
use PHPUnit\DbUnit\DataSet\DefaultTable;
use PHPUnit\DbUnit\DataSet\DefaultTableIterator;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Symfony\Component\Finder\Finder;
use Neighborhoods\Scaffolding\TestCase\Service;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Yaml\Tag\TaggedValue;
use Symfony\Component\Yaml\Yaml;
use PHPUnit\DbUnit\Operation\Factory;

abstract class AbstractTest extends DbUnit\TestCase
{
    use Service\AwareTrait;
    use Defensive\AwareTrait;
    public const    YML_SIGIL_PREFIX_FIXTURE_EXPRESSION = 'fixture/expression:';
    protected const PROP_DATA_SET = 'data_set';
    protected const PROP_EXPRESSION_VALUES = 'expression_values';
    protected $_containerBuilderFacade;
    protected $_testRootDirectoryFinder;

    /** @expectedException */
    public function setUp(): void
    {
        $this->_getContainerBuilderFacade()->addFinder($this->_getTestCaseRootDirectoryFinder());
        $containerBuilder = $this->_getContainerBuilderFacade()->getContainerBuilder();
        $this->setTestCaseService($containerBuilder->get('neighborhoods.scaffolding.testcase.service'));
        $tearDown = $containerBuilder->get('db.tear_down');
        $tearDown->uninstall();
        $setup = $containerBuilder->get('db.setup');
        $setup->install();
        $redis = $containerBuilder->get('redis.factory')->create();
        $redis->flushAll();

        parent::setUp();
    }

    protected function getSetUpOperation()
    {
        return Factory::CLEAN_INSERT(true);
    }

    protected function _getTestCaseRootDirectoryFinder(): Finder
    {
        if ($this->_testRootDirectoryFinder === null) {
            $testRootDirectoryFinder = new Finder();
            $testRootDirectoryFinder->files()->in($this->_getTestCaseRootDirectoryPath());
            $testRootDirectoryFinder->exclude(['fixtures']);
            $testRootDirectoryFinder->name('*.yml');
            $this->_testRootDirectoryFinder = $testRootDirectoryFinder;
        }

        return $this->_testRootDirectoryFinder;
    }

    protected function _getTestCaseRootDirectoryPath(): string
    {
        $reflectionClass = new ReflectionClass($this);
        $testClassFilePath = $reflectionClass->getFileName();
        $testClassDirectoryPath = dirname($testClassFilePath);
        $testCaseName = $this->getName();
        $testCaseRootDirectoryPath = $testClassDirectoryPath . '/' . $testCaseName;

        return $testCaseRootDirectoryPath;
    }

    protected function _getContainerBuilderFacade(): Facade
    {
        if ($this->_containerBuilderFacade === null) {
            $this->_containerBuilderFacade = Bootstrap::getContainerBuilderFacade();
        }

        return $this->_containerBuilderFacade;
    }

    protected function getConnection()
    {
        $pdo = $this->_getContainerBuilderFacade()->getContainerBuilder()->get('pdo.builder')->getPdo();

        return $this->createDefaultDBConnection($pdo);
    }

    protected function getDataSet()
    {
        $fixturesDirectoryPath = $this->_getTestCaseRootDirectoryPath() . '/fixtures';
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
        } else {
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
        return $this->_getContainerBuilderFacade()->getContainerBuilder()->get('nhds.toolkit.time');
    }
}