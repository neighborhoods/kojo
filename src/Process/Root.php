<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

class Root extends Forked implements ProcessInterface
{
    protected function run(): Forked
    {
        while (true) {
            $this->getProcessSignal()->waitForSignal();
        }

        return $this;
    }
}