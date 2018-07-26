<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\ProcessAbstract;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Semaphore;

class Server extends ProcessAbstract implements ServerInterface
{
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Repository\AwareTrait;
    const SERVER_SEMAPHORE_RESOURCE_NAME = 'server';

    public function start(): ProcessInterface
    {
        $this->initialize();
        $this->getLogger()->debug('Starting process pool server...');
        if ($this->getSemaphore()->testAndSetLock($this->getServerSemaphoreResource())) {
            $this->getLogger()->info('Process pool server started.');
            $this->getProcessPool()->start();
            while (true) {
                $this->getProcessSignal()->waitForSignal();
            }
        } else {
            $this->getLogger()->debug('Cannot obtain the process pool server mutex. Quitting.');
            $this->exit();
        }

        return $this;
    }

    protected function getServerSemaphoreResource(): Semaphore\ResourceInterface
    {
        $semaphoreResourceRepository = $this->getSemaphoreResourceRepository();
        $serverSemaphoreResource = $semaphoreResourceRepository->get(self::SERVER_SEMAPHORE_RESOURCE_NAME);

        return $serverSemaphoreResource;
    }
}