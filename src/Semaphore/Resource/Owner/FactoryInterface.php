<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): OwnerInterface;
}
