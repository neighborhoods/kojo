<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\ProcessAbstract;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Semaphore;
use Neighborhoods\Pylon\Data\Property;

class Server extends ProcessAbstract implements ServerInterface
{
    use Process\Pool\Factory\AwareTrait;
    use Logger\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;

    public const SERVER_SEMAPHORE_RESOURCE_NAME = 'server';

    public function start(): ProcessInterface
    {
        $this->_initialize();
        $this->_getLogger()->debug('Starting process pool server...');
        if ($this->_getSemaphore()->testAndSetLock($this->_getServerSemaphoreResource())) {
            $this->_getLogger()->debug('Process pool server started.');
            $this->_getProcessPool()->start();
            while (true) {
                $this->getProcessSignalDispatcher()->processBufferedSignals();
                sleep(1);
            }
        } else {
            $this->_getLogger()->debug('Cannot obtain the process pool server mutex. Quitting.');
            $this->exit();
        }

        return $this;
    }

    protected function _getServerSemaphoreResource(): Semaphore\ResourceInterface
    {
        return $this->_getSemaphoreResource(self::SERVER_SEMAPHORE_RESOURCE_NAME);
    }
}
