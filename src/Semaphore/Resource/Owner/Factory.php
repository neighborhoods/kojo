<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): OwnerInterface
    {
        return clone $this->getSemaphoreResourceOwner();
    }
}
