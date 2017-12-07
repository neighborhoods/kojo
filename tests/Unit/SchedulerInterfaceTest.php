<?php

namespace NHDS\Jobs\Test\Unit;

use NHDS\Watch\Fixture;

class SchedulerInterfaceTest extends Fixture\AbstractTest
{
    public function testSchedule()
    {
        $scheduler = $this->_getTestContainerBuilder()->get('nhds.jobs.scheduler');
        $scheduler->schedule();

        return $this;
    }
}