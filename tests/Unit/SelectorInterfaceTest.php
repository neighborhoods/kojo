<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Test\Unit\Data\Job;

use Neighborhoods\Scaffolding\Fixture;

class SelectorInterfaceTest extends Fixture\AbstractTest
{
    public function testPick()
    {
        $selector = $this->_getTestContainerBuilder()->get('selector');
        $selector->pick();

        return $this;
    }
}