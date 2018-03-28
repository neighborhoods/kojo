<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Test\Unit\Process\Pool;

use Neighborhoods\Scaffolding\Fixture\AbstractTest;

class ServerInterfaceTest extends AbstractTest
{
    /** @test */
    public function start()
    {
        $server = $this->_getTestContainerBuilder()->get('neighborhoods.kojo.process.pool.server');

//        $server->start();
    }
}