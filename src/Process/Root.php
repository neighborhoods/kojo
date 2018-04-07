<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

class Root extends Forked implements ProcessInterface
{
    const TYPE_CODE = 'root';

    public function __construct()
    {
        $this->setTypeCode(self::TYPE_CODE);
    }

    protected function _run(): Forked
    {
        while (true) {
            $this->_getProcessSignal()->waitForSignal();
        }

        return $this;
    }
}