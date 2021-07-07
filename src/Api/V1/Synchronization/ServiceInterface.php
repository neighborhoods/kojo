<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Synchronization;

interface ServiceInterface
{
    public function tryAcquireMutex(string $id) : bool;

    public function hasMutex(string $id) : bool;

    public function releaseMutex(string $id) : ServiceInterface;
}
