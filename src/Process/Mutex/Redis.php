<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Mutex;

use NHDS\Jobs\ProcessAbstract;
use NHDS\Jobs\ProcessInterface;

class Redis extends ProcessAbstract
{
    public function start(): ProcessInterface
    {
        $this->_register();
        return $this;
    }

    protected function _register()
    {

    }
}