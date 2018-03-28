<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Test\Unit;

use Neighborhoods\Scaffolding\Fixture;

class SchedulerInterfaceTest extends Fixture\AbstractTest
{
    public function testSchedule()
    {
        $scheduler = $this->_getTestContainerBuilder()->get('neighborhoods.kojo.scheduler');
        $scheduler->scheduleStaticJobs();

        return $this;
    }
}