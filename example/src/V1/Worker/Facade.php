<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker;

use Neighborhoods\KojoExample\V1\WorkerInterface;
use Neighborhoods\Pylon\DependencyInjection;
use Symfony\Component\Finder\Finder;

class Facade implements FacadeInterface
{
    protected $worker;

    public function start(): FacadeInterface
    {
        $this->bootstrap();
        $this->getWorker()->work();

        return $this;
    }

    protected function bootstrap(): FacadeInterface
    {
        $containerBuilderFacade = new DependencyInjection\ContainerBuilder\Facade();
        $discoverableDirectories[] = __DIR__ . '/../../../src';
        $finder = new Finder();
        $finder->name('*.yml');
        $finder->files()->in($discoverableDirectories);
        $containerBuilderFacade->addFinder($finder);
        $containerBuilder = $containerBuilderFacade->getContainerBuilder();
        $this->setWorker($containerBuilder->get('neighborhoods.kojo_example.v1.worker'));

        return $this;
    }

    public function getWorker(): WorkerInterface
    {
        if ($this->worker === null) {
            throw new \LogicException('Worker has not been set.');
        }

        return $this->worker;
    }

    public function setWorker(WorkerInterface $worker): FacadeInterface
    {
        if ($this->worker !== null) {
            throw new \LogicException('Worker already set.');
        }
        $this->worker = $worker;

        return $this;
    }
}