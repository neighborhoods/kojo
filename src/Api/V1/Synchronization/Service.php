<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Synchronization;

use Neighborhoods\Kojo\Semaphore;

class Service implements ServiceInterface
{
    use Semaphore\Resource\Factory\AwareTrait;

    // TODO: consider "namespacing" userspace mutex IDs to make sure there aren't any collisions
    // with kojospace mutex IDs
    public function tryAcquireMutex(string $id) : bool
    {
        try {
            $didAcquireMutex = $this->_getSemaphoreResource($id)->testAndSetLock();
        } catch (\Throwable $throwable) {
            $didAcquireMutex = false;

            // log
        }

        return $didAcquireMutex;
    }

    public function hasMutex(string $id) : bool
    {
        return $this->_getSemaphoreResource($id)->hasLock();
    }

    public function releaseMutex(string $id) : ServiceInterface
    {
        $this->_getSemaphoreResource($id)->releaseLock();

        return $this;
    }
}
