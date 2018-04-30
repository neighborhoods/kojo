<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type;

use Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\Facade;
use Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\FacadeInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

class Service implements ServiceInterface
{
    protected const REGISTRAR_FACTORY_SERVICE_ID = 'api.v1.job.type.registrar.factory';
    protected $_containerBuilderFacade;
    protected $_kojoDiFinder;
    protected $_kojoApplicationDirectoryPath;

    public function addYmlServiceFinder(Finder $ymlServiceFinder): ServiceInterface
    {
        $this->_getContainerBuilderFacade()->addFinder($ymlServiceFinder);

        return $this;
    }

    public function getNewJobTypeRegistrar(): RegistrarInterface
    {
        return $this->_getContainerBuilder()->get(self::REGISTRAR_FACTORY_SERVICE_ID)->create();
    }

    protected function _getContainerBuilder(): ContainerBuilder
    {
        return $this->_getContainerBuilderFacade()->getContainerBuilder();
    }

    protected function _getContainerBuilderFacade(): FacadeInterface
    {
        if ($this->_containerBuilderFacade === null) {
            $containerBuilderFacade = new Facade();
            $containerBuilderFacade->addFinder($this->_getKojoDiFinder());
            $this->_containerBuilderFacade = $containerBuilderFacade;
        }

        return $this->_containerBuilderFacade;
    }

    protected function _getKojoDiFinder()
    {
        if ($this->_kojoDiFinder === null) {
            $kojoDiFinder = new Finder();
            $kojoDiFinder->name('*.yml');
            $kojoDiFinder->files()->in($this->_getKojoApplicationDirectoryPath());

            $this->_kojoDiFinder = $kojoDiFinder;
        }

        return $this->_kojoDiFinder;
    }

    protected function _getKojoApplicationDirectoryPath(): string
    {
        if ($this->_kojoApplicationDirectoryPath === null) {
            $this->_kojoApplicationDirectoryPath = dirname(__FILE__) . '/../../../../../src';
        }

        return $this->_kojoApplicationDirectoryPath;
    }
}