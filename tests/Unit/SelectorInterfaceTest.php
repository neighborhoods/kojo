<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Unit\Data\Job;

use NHDS\Watch\Fixture;

class SelectorInterfaceTest extends Fixture\AbstractTest
{
    public function testPick()
    {
        $selector = $this->_getTestContainerBuilder()->get('selector');
        $selector->pick();

        return $this;
    }
}