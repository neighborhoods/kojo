<?php

namespace NHDS\Jobs\Test\Unit;

use NHDS\Watch\Fixture;

class MaintainerInterfaceTest extends Fixture\AbstractTest
{
    public function testMaintain()
    {
        $maintainer = $this->_getTestContainerBuilder()->get('nhds.jobs.maintainer');
        $maintainer->updatePendingJobs();
        $maintainer->rescheduleCrashedJobs();

        return $this;
    }
}