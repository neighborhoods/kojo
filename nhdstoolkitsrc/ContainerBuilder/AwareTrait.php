<?php
declare(strict_types=1);

namespace NHDS\Toolkit\ContainerBuilder;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;

trait AwareTrait
{
    protected $_servicesYamlFilePaths = [];
    protected $_containerBuilder;

    public function addServicesYmlFilePath(string $servicesYamlFilePath)
    {
        if (!isset($this->_servicesYamlFilePaths[$servicesYamlFilePath])) {
            $this->_servicesYamlFilePaths[$servicesYamlFilePath] = $servicesYamlFilePath;
        }else {

            throw new \LogicException('Services YML file path "' . $servicesYamlFilePath . '" is already set.');
        }

        return $this;
    }

    protected function _getServicesYmlFilePaths(): array
    {
        if (empty($this->_servicesYamlFilePaths)) {
            throw new \LogicException('Services YML file paths is empty.');
        }

        return $this->_servicesYamlFilePaths;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->_containerBuilder === null) {
            $containerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
            foreach ($this->_getServicesYmlFilePaths() as $servicesYmlFilePath) {
                $loader->import($servicesYmlFilePath);
            }
            $passes = [new AnalyzeServiceReferencesPass(), new InlineServiceDefinitionsPass()];
            $repeatedPass = new RepeatedPass($passes);
            $repeatedPass->process($containerBuilder);
            $containerBuilder->set('container_builder', $containerBuilder);
            $this->_containerBuilder = $containerBuilder;
        }

        return $this->_containerBuilder;
    }
}