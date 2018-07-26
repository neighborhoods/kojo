<?php
declare(strict_types=1);

namespace Neighborhoods\Pylon\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

interface FacadeInterface
{
    public function addFinder(Finder $finder): Facade;

    public function getContainerBuilder(): ContainerBuilder;
}