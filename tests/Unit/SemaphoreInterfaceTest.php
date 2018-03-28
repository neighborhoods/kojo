<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Test\Unit;

use Neighborhoods\Kojo\Semaphore\Resource\Owner;
use Neighborhoods\Scaffolding\AbstractTest;

class SemaphoreInterfaceTest extends AbstractTest
{
    public function testTestAndSetLock()
    {
        $semaphore = $this->_getTestContainerBuilder()->get('neighborhoods.kojo.semaphore');
        $resource = $this->_getTestContainerBuilder()->get('neighborhoods.kojo.semaphore.resource-job');
        $job = $this->_getTestContainerBuilder()->get('neighborhoods.kojo.data.job');
        $job->setId(15);
        $job->setTypeCode('type_code');
        $job->setCanWorkInParallel(true);
        $resourceOwner = $resource->getResourceOwner();
        if ($resourceOwner instanceof Owner\Job) {
            $resourceOwner->setJob($job);
        }
        $semaphore->testAndSetLock($resource);

        return $this;
    }
}