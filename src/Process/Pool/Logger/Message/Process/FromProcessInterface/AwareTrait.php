<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterfaceInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface;

    public function setProcessPoolLoggerMessageProcessFromProcessInterface(
        FromProcessInterfaceInterface $ProcessPoolLoggerMessageProcessFromProcessInterface
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessInterface()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface = $ProcessPoolLoggerMessageProcessFromProcessInterface;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessInterface(
    ) : FromProcessInterfaceInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterface()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessInterface() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessInterface() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterface()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterface);

        return $this;
    }
}
