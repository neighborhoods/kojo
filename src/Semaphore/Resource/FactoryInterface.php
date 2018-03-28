<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\MutexInterface;
use Neighborhoods\Kojo\Semaphore\ResourceInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setMutex(MutexInterface $job);

    public function setSemaphoreResource(ResourceInterface $resource);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): ResourceInterface;
}