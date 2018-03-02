<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Unit\Process\Pool;

use Neighborhoods\Scaffolding\Fixture\AbstractTest;

class ServerInterfaceTest extends AbstractTest
{
    /** @test */
    public function start()
    {
        $server = $this->_getTestContainerBuilder()->get('nhds.jobs.process.pool.server');

//        $server->start();
    }
}