<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\Pool;
use NHDS\Toolkit\Time;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Semaphore;

class Server implements ServerInterface
{
    use Crud\AwareTrait;
    use Logger\AwareTrait;
    use Time\AwareTrait;
    use Pool\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    const SERVER_SEMAPHORE_RESOURCE_NAME = 'server';

    public function start(): ServerInterface
    {
        $this->_getPool()->initialize();
        $this->_getLogger()->info("Starting ProcessPool server...");
        if (!$this->_getSemaphore()->testAndSetLock($this->_getServerSemaphoreResource())) {
            $this->_getLogger()->alert('Cannot obtain service mutex.');
            $this->_exit(0);
        }
        $this->_getLogger()->info("ProcessPool server started.");
        $this->_getLogger()->info("Starting ProcessPool...");
        $this->_getPool()->swim();
        $this->_getLogger()->info("ProcessPool stopped.");
        $this->_getLogger()->info("Stopping ProcessPool server.");
        $this->_getSemaphore()->releaseLock($this->_getServerSemaphoreResource());
        $this->_getLogger()->info('ProcessPool server stopped.');

        return $this;
    }

    protected function _getServerSemaphoreResource(): Semaphore\ResourceInterface
    {
        return $this->_getSemaphoreResource(self::SERVER_SEMAPHORE_RESOURCE_NAME);
    }

    protected function _exit(int $exitCode)
    {
        $this->_getLogger()->info('Exiting Server.');
        exit($exitCode);
    }
}