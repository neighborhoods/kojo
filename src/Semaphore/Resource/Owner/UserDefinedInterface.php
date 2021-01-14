<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;

interface UserDefinedInterface extends OwnerInterface
{
    public function setResourceName(string $resourceName) : UserDefinedInterface;
}
