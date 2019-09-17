<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcess;

    public function setProcessPoolLoggerMessageProcess(
        SerializableProcessInterface $ProcessPoolLoggerMessageProcess
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

    protected function getProcessPoolLoggerMessageProcess() : SerializableProcessInterface
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
