<?php

namespace NHDS\Jobs\Test\Unit;


use NHDS\Watch\AbstractTest;

class SemaphoreInterfaceTest extends AbstractTest
{
    public function testTestAndSetLock()
    {
        $semaphore = $this->_getTestContainerBuilder()->get('nhds.jobs.semaphore');
        $resource = $this->_getTestContainerBuilder()->get('nhds.jobs.semaphore.resource-job');

        $semaphore->testAndSetLock($resource);

        return $this;
    }
}