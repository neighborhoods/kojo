<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Unit;

use NHDS\Watch\Fixture;

class SchedulerInterfaceTest extends Fixture\AbstractTest
{
    public function testSchedule()
    {
        $scheduler = $this->_getTestContainerBuilder()->get('nhds.jobs.scheduler');
        $scheduler->scheduleStaticJobs();

        return $this;
    }
}