<?php

namespace NHDS\Jobs\Test\Unit;


use NHDS\Watch\AbstractTest;

class SemaphoreInterfaceTest extends AbstractTest
{
    public function testTestAndSetLock()
    {
        $semaphore = $this->_getTestContainerBuilder()->get('nhds.jobs.semaphore');
        $resource = $this->_getTestContainerBuilder()->get('nhds.jobs.semaphore.resource-job');
        $job = $this->_getTestContainerBuilder()->get('nhds.jobs.data.job');
        $job->setId(15);
        $job->setTypeCode('type_code');
        $job->setCanWorkInParallel(true);
        $resource->getResourceOwner()->setJob($job);
        $semaphore->testAndSetLock($resource);

        return $this;
    }
}