<?php

namespace NHDS\Jobs\Test\Unit;

use NHDS\Jobs\ForemanInterface;
use NHDS\Jobs\Test\Unit\Fixture\AbstractTest;

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
        return $this->_getTestContainerBuilder()->get('foreman');
    }
}