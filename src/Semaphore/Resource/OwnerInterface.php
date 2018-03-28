<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

interface OwnerInterface
{
    public function getResourceName(): string;

    public function getResourcePath(): string;

    public function getIsBlocking(): bool;
}