<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Symfony\Component\DependencyInjection\ContainerBuilder;

use Neighborhoods\Kojo\Symfony\Component\Finder\FinderArray;
use Neighborhoods\Kojo\Symfony\Component\Finder\FinderArrayInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;
use Symfony\Component\Finder\Finder;

class Facade implements FacadeInterface
{
    protected $containerBuilder;
    protected $yamlServicesFilePaths = [];
    protected $finderArray;
    protected $containerIsBuilt = false;
    protected $isYamlAssembled = false;

    public function addFinder(Finder $finder): Facade
    {
        $this->_getFinderArray()->append($finder);

        return $this;
    }

    protected function _getFinderArray(): FinderArrayInterface
    {
        if ($this->finderArray === null) {
            $this->finderArray = new FinderArray();
        }

        return $this->finderArray;
    }

    protected function _getYamlServicesFilePaths(): array
    {
        if (empty($this->yamlServicesFilePaths)) {
            foreach ($this->_getFinderArray() as $finder) {
                foreach ($finder as $directoryPath => $file) {
                    $this->yamlServicesFilePaths[] = $file->getPathname();
                }
            }
        }

        return $this->yamlServicesFilePaths;
    }

    public function setContainerBuilder(ContainerBuilder $containerBuilder): FacadeInterface
    {
        if ($this->containerBuilder === null) {
            $this->containerBuilder = $containerBuilder;
        } else {
            throw new \LogicException('Container builder is already set.');
        }

        return $this;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->containerBuilder === null) {
            throw new \LogicException('Container builder is not set.');
        }

        return $this->containerBuilder;
    }

    public function assembleYaml(): FacadeInterface
    {
        if ($this->isYamlAssembled === false) {
            $containerBuilder = $this->getContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
            foreach ($this->_getYamlServicesFilePaths() as $servicesYmlFilePath) {
                $loader->import($servicesYmlFilePath);
            }
        } else {
            throw new \LogicException('Yaml is already assembled.');
        }

        return $this;
    }

    public function build(): FacadeInterface
    {
        if ($this->containerIsBuilt === false) {
            $containerBuilder = $this->getContainerBuilder();

            $passes = [new AnalyzeServiceReferencesPass(), new InlineServiceDefinitionsPass()];
            $repeatedPass = new RepeatedPass($passes);
            $repeatedPass->process($containerBuilder);
            $containerBuilder->compile(true);
            $this->containerIsBuilt = true;
        } else {
            throw new \LogicException('Container is already built.');
        }

        return $this;
    }
}