<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Unit;

use NHDS\Jobs\ForemanInterface;
use NHDS\Jobs\Process\JobInterface;
use NHDS\Jobs\SelectorInterface;
use NHDS\Watch\Fixture\AbstractTest;

class ForemanInterfaceTest extends AbstractTest
{
    /** @test */
    public function workWorkers(): ForemanInterfaceTest
    {
        $this->_getSelector()->setProcess($this->_getJobProcess());
        $foreman = $this->_getForeman();
        $foreman->workWorker();

        return $this;
    }

    protected function _getForeman(): ForemanInterface
    {
        return $this->_getTestContainerBuilder()->get('foreman');
    }

    protected function _getSelector(): SelectorInterface
    {
        return $this->_getTestContainerBuilder()->get('selector');
    }

    protected function _getJobProcess(): JobInterface
    {
        return $this->_getTestContainerBuilder()->get('process.job');
    }

    protected function _getRequiredJobProcess(): JobInterface
    {
        return $this->_getTestContainerBuilder()->get('process.job.required');
    }
}