<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess;

    public function setProcessPoolLoggerMessageSerializableProcess(
        SerializableProcessInterface $ProcessPoolLoggerMessageSerializableProcess
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcess()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess = $ProcessPoolLoggerMessageSerializableProcess;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcess() : SerializableProcessInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcess()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcess() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcess() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcess()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcess);

        return $this;
    }
}
