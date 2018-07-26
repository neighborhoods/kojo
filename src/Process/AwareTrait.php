<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcess;

    public function setProcess(ProcessInterface $process): self
    {
        if ($this->hasProcess()) {
            throw new \LogicException('NeighborhoodsKojoProcess is already set.');
        }
        $this->NeighborhoodsKojoProcess = $process;

        return $this;
    }

    protected function getProcess(): ProcessInterface
    {
        if (!$this->hasProcess()) {
            throw new \LogicException('NeighborhoodsKojoProcess is not set.');
        }

        return $this->NeighborhoodsKojoProcess;
    }

    protected function hasProcess(): bool
    {
        return isset($this->NeighborhoodsKojoProcess);
    }

    protected function unsetProcess(): self
    {
        if (!$this->hasProcess()) {
            throw new \LogicException('NeighborhoodsKojoProcess is not set.');
        }
        unset($this->NeighborhoodsKojoProcess);

        return $this;
    }
}
