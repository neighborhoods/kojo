<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

class Root extends Forked implements ProcessInterface
{
    const TYPE_CODE = 'root';

    public function __construct()
    {
        $this->setTypeCode(self::TYPE_CODE);
    }

    protected function _run(): Forked
    {
        return $this;
    }

    public function processPoolStarted(): ProcessInterface
    {
        return $this;
    }
}