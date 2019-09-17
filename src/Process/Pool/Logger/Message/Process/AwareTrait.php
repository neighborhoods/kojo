<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\ProcessInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcess;

    public function setProcessPoolLoggerMessageProcess(
        ProcessInterface $ProcessPoolLoggerMessageProcess
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcess()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcess is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcess = $ProcessPoolLoggerMessageProcess;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcess() : ProcessInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcess()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcess is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcess;
    }

    protected function hasProcessPoolLoggerMessageProcess() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcess);
    }

    protected function unsetProcessPoolLoggerMessageProcess() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcess()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcess is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcess);

        return $this;
    }
}
