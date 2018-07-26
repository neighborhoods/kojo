<?php
declare(strict_types=1);

namespace Neighborhoods\KojoTest\Unit;

use Neighborhoods\Kojo\ForemanInterface;
use Neighborhoods\Kojo\Process\WorkerInterface;
use Neighborhoods\Kojo\SelectorInterface;
use Neighborhoods\Scaffolding\Fixture\AbstractTest;

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
        return $this->_getContainerBuilderFacade()->getContainerBuilder()->get('foreman');
    }

    protected function _getSelector(): SelectorInterface
    {
        return $this->_getContainerBuilderFacade()->getContainerBuilder()->get('selector');
    }

    protected function _getJobProcess(): WorkerInterface
    {
        return $this->_getContainerBuilderFacade()->getContainerBuilder()->get('Worker');
    }
}