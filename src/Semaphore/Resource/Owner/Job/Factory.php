<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner\Job;

use Neighborhoods\Kojo\Semaphore\Resource\Owner\JobInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): JobInterface
    {
        return clone $this->getSemaphoreResourceOwnerJob();
    }
}
