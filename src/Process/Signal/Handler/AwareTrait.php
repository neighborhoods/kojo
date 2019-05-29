<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler;

use LogicException;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignalHandler;

    public function setProcessSignalHandler(HandlerInterface $processSignalHandler): self
    {
        if ($this->hasProcessSignalHandler()) {
            throw new LogicException('NeighborhoodsKojoProcessSignalHandler is already set.');
        }
        $this->NeighborhoodsKojoProcessSignalHandler = $processSignalHandler;

        return $this;
    }

    protected function getProcessSignalHandler(): HandlerInterface
    {
        if (!$this->hasProcessSignalHandler()) {
            throw new LogicException('NeighborhoodsKojoProcessSignalHandler is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignalHandler;
    }

    protected function hasProcessSignalHandler(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignalHandler);
    }

    protected function unsetProcessSignalHandler(): self
    {
        if (!$this->hasProcessSignalHandler()) {
            throw new LogicException('NeighborhoodsKojoProcessSignalHandler is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignalHandler);

        return $this;
    }
}
