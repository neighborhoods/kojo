<?php
declare(strict_types=1);

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

    public function start(): ProcessInterface
    {
        $this->_initialize();
        $this->_getLogger()->info('Starting process pool server...');
        if ($this->_getSemaphore()->testAndSetLock($this->_getServerSemaphoreResource())) {
            $this->_getLogger()->info('Process pool server started.');
            $this->setProcessPool($this->_getProcessPoolFactory()->create());
            $this->_getProcessPool()->setProcess($this);
            $this->_getProcessPool()->start();
        }else {
            $this->_getLogger()->info('Cannot obtain process pool server mutex. Quitting.');
        }

        return $this;
    }

    protected function _getServerSemaphoreResource(): Semaphore\ResourceInterface
    {
        return $this->_getSemaphoreResource(self::SERVER_SEMAPHORE_RESOURCE_NAME);
    }

    public function processPoolStarted(): ProcessInterface
    {
        while (true) {
            $this->_getProcessPool()->waitForSignal();
        }

        return $this;
    }
}