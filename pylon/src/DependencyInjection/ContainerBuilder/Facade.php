<?php
declare(strict_types=1);

namespace Neighborhoods\Pylon\DependencyInjection\ContainerBuilder;

use Neighborhoods\Pylon\Symfony\Component\FinderArray;
use Neighborhoods\Pylon\Symfony\Component\FinderArrayInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;
use Symfony\Component\Finder\Finder;

class Facade implements FacadeInterface
{
    protected $_containerBuilder;
    protected $_yamlServicesFilePaths = [];
    protected $_finderArray;

    public function addFinder(Finder $finder): Facade
    {
        $this->_getFinderArray()->append($finder);

        return $this;
    }

    protected function _getFinderArray(): FinderArrayInterface
    {
        if ($this->_finderArray === null) {
            $this->_finderArray = new FinderArray();
        }

        return $this->_finderArray;
    }

    protected function _getYamlServicesFilePaths(): array
    {
        if (empty($this->_yamlServicesFilePaths)) {
            foreach ($this->_getFinderArray() as $finder) {
                foreach ($finder as $directoryPath => $file) {
                    $this->_yamlServicesFilePaths[] = $file->getPathname();
                }
            }
        }

        return $this->_yamlServicesFilePaths;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->_containerBuilder === null) {
            $containerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
            foreach ($this->_getYamlServicesFilePaths() as $servicesYmlFilePath) {
                $loader->import($servicesYmlFilePath);
            }
            $passes = [new AnalyzeServiceReferencesPass(), new InlineServiceDefinitionsPass()];
            $repeatedPass = new RepeatedPass($passes);
            $repeatedPass->process($containerBuilder);
            $containerBuilder->compile(true);
            $this->_containerBuilder = $containerBuilder;
        }

        return $this->_containerBuilder;
    }
}