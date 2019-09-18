<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Dispatcher;

use LogicException;
use Neighborhoods\Kojo\Process\Signal\DispatcherInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignalDispatcher;

    public function setProcessSignalDispatcher(DispatcherInterface $processSignalDispatcher): self
    {
        if ($this->hasProcessSignalDispatcher()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Dispatcher is already set.');
        }
        $this->NeighborhoodsKojoProcessSignalDispatcher = $processSignalDispatcher;

        return $this;
    }

    protected function getProcessSignalDispatcher(): DispatcherInterface
    {
        if (!$this->hasProcessSignalDispatcher()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Dispatcher is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignalDispatcher;
    }

    protected function hasProcessSignalDispatcher(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignalDispatcher);
    }

    protected function unsetProcessSignalDispatcher(): self
    {
        if (!$this->hasProcessSignalDispatcher()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Dispatcher is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignalDispatcher);

        return $this;
    }
}
