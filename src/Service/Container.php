<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;

class Container
{
    protected $_containerBuilder;
    protected $_yamlServicesFilePaths = [];
    protected $_rootDirectoryPaths    = [];

    public function addRootDirectoryPath(string $rootDirectoryPath): Container
    {
        if (isset($this->_rootDirectoryPaths[$rootDirectoryPath])) {
            throw new \LogicException("Root directory path[$rootDirectoryPath] is already set.");
        }
        $this->_rootDirectoryPaths[] = $rootDirectoryPath;

        return $this;
    }

    protected function _getRootDirectoryPaths(): array
    {
        return $this->_rootDirectoryPaths;
    }

    protected function _getYamlServicesFilePaths(): array
    {
        if (empty($this->_yamlServicesFilePaths)) {
            foreach ($this->_getRootDirectoryPaths() as $rootDirectoryPath) {
                $recursiveDirectoryIterator = new \RecursiveDirectoryIterator($rootDirectoryPath);
                foreach (new \RecursiveIteratorIterator($recursiveDirectoryIterator) as $file) {
                    $extension = $file->getExtension();
                    if (strtolower($extension) == 'yml') {
                        $this->_yamlServicesFilePaths[] = $file->getPathname();
                    }
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