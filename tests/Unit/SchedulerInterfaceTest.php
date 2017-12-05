<?php

namespace NHDS\Jobs\Test\Unit;

class SchedulerInterfaceTest extends Fixture\AbstractTest
{
    public function testSchedule()
    {
        $scheduler = $this->_getTestContainerBuilder()->get('scheduler');
        $scheduler->schedule();

        return $this;
    }
}