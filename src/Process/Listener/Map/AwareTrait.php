<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener\Map;

use Neighborhoods\Kojo\Process\Listener\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessListenerMap;

    public function setProcessListenerMap(MapInterface $processListenerMap): self
    {
        if ($this->hasProcessListenerMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessListenerMap is already set.');
        }
        $this->NeighborhoodsKojoProcessListenerMap = $processListenerMap;

        return $this;
    }

    protected function getProcessListenerMap(): MapInterface
    {
        if (!$this->hasProcessListenerMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessListenerMap is not set.');
        }

        return $this->NeighborhoodsKojoProcessListenerMap;
    }

    protected function hasProcessListenerMap(): bool
    {
        return isset($this->NeighborhoodsKojoProcessListenerMap);
    }

    protected function unsetProcessListenerMap(): self
    {
        if (!$this->hasProcessListenerMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessListenerMap is not set.');
        }
        unset($this->NeighborhoodsKojoProcessListenerMap);

        return $this;
    }
}
