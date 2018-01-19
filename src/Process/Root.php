<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Process;

class Root extends Forkable
{
    use Process\Pool\Factory\AwareTrait;
    const TYPE_CODE = 'root';

    public function __construct()
    {
        $this->setTypeCode(self::TYPE_CODE);
    }

    protected function _run(): Forkable
    {
        $this->setProcessPool($this->_getProcessPoolFactory()->create());
        $this->_getProcessPool()->setProcess($this);
        $this->_getProcessPool()->start();

        return $this;
    }
}