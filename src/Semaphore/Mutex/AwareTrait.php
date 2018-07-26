<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Mutex;

use Neighborhoods\Kojo\Semaphore\MutexInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreMutex;

    public function setSemaphoreMutex(MutexInterface $semaphoreMutex): self
    {
        if ($this->hasSemaphoreMutex()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreMutex is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreMutex = $semaphoreMutex;

        return $this;
    }

    protected function getSemaphoreMutex(): MutexInterface
    {
        if (!$this->hasSemaphoreMutex()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreMutex is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreMutex;
    }

    protected function hasSemaphoreMutex(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreMutex);
    }

    protected function unsetSemaphoreMutex(): self
    {
        if (!$this->hasSemaphoreMutex()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreMutex is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreMutex);

        return $this;
    }
}
