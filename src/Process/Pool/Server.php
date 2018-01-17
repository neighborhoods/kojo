<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessAbstract;
use NHDS\Jobs\ProcessInterface;
use NHDS\Jobs\Semaphore;
use NHDS\Toolkit\Data\Property;
use NHDS\Jobs\Process;

class Server extends ProcessAbstract implements ServerInterface
{
    use Process\Pool\Factory\AwareTrait;
    use Property\Strict\AwareTrait;
    use Logger\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    const SERVER_SEMAPHORE_RESOURCE_NAME = 'server';
    const TYPE_CODE                      = 'server';

    public function __construct()
    {
        $this->setTypeCode(self::TYPE_CODE);

        return $this;
    }

    public function start(): ProcessInterface
    {
        $this->_initialize();
        $this->_getLogger()->info("Starting process pool server...");
        if (!$this->_getSemaphore()->testAndSetLock($this->_getServerSemaphoreResource())) {
            $this->_getLogger()->alert('Cannot obtain process pool server mutex.');
            $this->_exit(0);
        }
        $this->_getLogger()->info("Process pool server started.");
        $this->setProcessPool($this->_getProcessPoolFactory()->create());
        $this->_getProcessPool()->start();
        $this->_getProcessPool()->emptyProcesses();
        $this->_deleteProcessPool();
        $this->_getLogger()->info("Stopping process pool server.");
        $this->_getSemaphore()->releaseLock($this->_getServerSemaphoreResource());
        $this->_getLogger()->info('Process pool server stopped.');

        return $this;
    }

    protected function _getServerSemaphoreResource(): Semaphore\ResourceInterface
    {
        return $this->_getSemaphoreResource(self::SERVER_SEMAPHORE_RESOURCE_NAME);
    }

    protected function _exit(int $exitCode)
    {
        $this->_getLogger()->info('Exiting process pool server.');
        exit($exitCode);
    }
}