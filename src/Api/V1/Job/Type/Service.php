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
            $this->_containerBuilderFacade = new Facade();
        }

        return $this->_containerBuilderFacade;
    }
}