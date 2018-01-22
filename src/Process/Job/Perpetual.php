<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Job;

use NHDS\Jobs\Process\Forkable;
use NHDS\Jobs\ProcessInterface;
use NHDS\Jobs\Worker\Bootstrap;

class AutoSchedule extends Forkable implements ProcessInterface
{
    use Bootstrap\AwareTrait;

    protected function _run(): Forkable
    {
        $this->_getBootstrap()->instantiate();



        return $this;
    }
}