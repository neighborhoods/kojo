<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

class Root extends Forked
{
    public const TYPE_CODE = 'root';

    public function __construct()
    {
        $this->setTypeCode(self::TYPE_CODE);
    }

    protected function _run(): Forked
    {
        while (true) {
            $this->getProcessSignalDispatcher()->processBufferedSignals();
            sleep(1);
        }

        return $this;
    }
}
