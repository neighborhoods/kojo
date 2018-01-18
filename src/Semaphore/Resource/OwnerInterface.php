<?php
declare(strict_types=1);

namespace NHDS\Jobs\Semaphore\Resource;

interface OwnerInterface
{
    public function getResourceName(): string;

    public function getResourcePath(): string;

    public function getIsBlocking(): bool;
}