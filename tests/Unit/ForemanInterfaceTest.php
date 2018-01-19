<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Unit;

use NHDS\Jobs\ForemanInterface;
use NHDS\Watch\Fixture\AbstractTest;

class ForemanInterfaceTest extends AbstractTest
{
    /** @test */
    public function workWorkers(): ForemanInterfaceTest
    {
        $foreman = $this->_getForeman();
        $foreman->work();

        return $this;
    }

    protected function _getForeman(): ForemanInterface
    {
        return $this->_getTestContainerBuilder()->get('nhds.jobs.foreman');
    }
}