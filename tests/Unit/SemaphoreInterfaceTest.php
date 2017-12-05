<?php

namespace NHDS\Jobs\Test\Unit;

use NHDS\Jobs\SemaphoreInterface;

class SemaphoreInterfaceTest extends AbstractTest
{
    /** @test */
    public function nested()
    {
        $semaphore = $this->_getSemaphore();

        return $this;
    }

    protected function _getSemaphore(): SemaphoreInterface
    {
        return $this->_getTestContainerBuilder()->get('semaphore');
    }
}