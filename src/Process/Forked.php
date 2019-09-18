<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use ErrorException;
use Neighborhoods\Kojo\Process\Forked\Exception;
use Neighborhoods\Kojo\ProcessAbstract;
use Neighborhoods\Kojo\ProcessInterface;

abstract class Forked extends ProcessAbstract
{
    protected const PROP_HAS_FORKED = 'has_forked';

    public function start(): ProcessInterface
    {
        $this->_create(self::PROP_HAS_FORKED, true);
        try {
            $processId = $this->_getProcessStrategy()->fork();
        } /** @noinspection PhpRedundantCatchClauseInspection */
        catch (ErrorException $errorException) {
            throw (new Exception())->setCode(Exception::CODE_FORK_FAILED)->setPrevious($errorException);
        }

        if ($processId > 0) {
            // This is executed in the parent process.
            $this->_setProcessId($processId);
        } else {
            // This is executed in the child process.
            $this->_initialize();
            $this->_getProcessPool()->start();
            $this->_run();
            $this->exit();
        }

        return $this;
    }

    abstract protected function _run(): Forked;
}
