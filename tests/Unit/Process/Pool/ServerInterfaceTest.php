<?php

namespace NHDS\Jobs\Test\Unit\Process\Pool;

use NHDS\Jobs\Test\Unit\AbstractTest;

class ServerInterfaceTest extends AbstractTest
{
    /** @test */
    public function start()
    {
        $server = $this->_getTestContainerBuilder()->get('server');

        $server->start();
    }
}