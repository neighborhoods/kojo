<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker;

use Neighborhoods\KojoExample\V1\WorkerInterface;
use Neighborhoods\Pylon\DependencyInjection;
use Symfony\Component\Finder\Finder;

class Facade implements FacadeInterface
{
    protected $worker;
    protected $isBootStrapped = false;

    public function start(): FacadeInterface
    {
        $this->bootstrap();
        $this->getWorker()->work();

        return $this;
    }

    protected function bootstrap(): FacadeInterface
    {
        if ($this->isBootStrapped !== false) {
            throw new \LogicException('Worker facade is already bootstrapped.');
        }
        $containerBuilderFacade = new DependencyInjection\ContainerBuilder\Facade();
        $discoverableDirectories[] = __DIR__ . '/../../../src';
        $finder = new Finder();
        $finder->name('*.yml');
        $finder->files()->in($discoverableDirectories);
        $containerBuilderFacade->addFinder($finder);
        $containerBuilder = $containerBuilderFacade->getContainerBuilder();
        $this->setWorker($containerBuilder->get('neighborhoods.kojo_example.v1.worker'));
        $this->isBootStrapped = true;

        return $this;
    }

    public function getWorker(): WorkerInterface
    {
        if ($this->worker === null) {
            throw new \LogicException('Worker is not set.');
        }

        return $this->worker;
    }

    public function setWorker(WorkerInterface $worker): FacadeInterface
    {
        if ($this->worker !== null) {
            throw new \LogicException('Worker is already set.');
        }
        $this->worker = $worker;

        return $this;
    }
}