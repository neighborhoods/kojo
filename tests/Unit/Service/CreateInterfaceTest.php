<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Test\Unit\Data\Job;

use Neighborhoods\Scaffolding\Fixture;

class CreateInterfaceTest extends Fixture\AbstractTest
{
    public function testPick()
    {
        $time = $this->_getTestContainerBuilder()->get('nhds.toolkit.time');
        $create = $this->_getTestContainerBuilder()->get('service.create');
        $create->setJobTypeCode('type_code_2');
        $create->setWorkAtDateTime($time->getNow());
        $create->save();

        return $this;
    }
}