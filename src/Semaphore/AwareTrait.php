<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

use Neighborhoods\Kojo\SemaphoreInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphore;

    public function setSemaphore(SemaphoreInterface $semaphore): self
    {
        if ($this->hasSemaphore()) {
            throw new \LogicException('NeighborhoodsKojoSemaphore is already set.');
        }
        $this->NeighborhoodsKojoSemaphore = $semaphore;

        return $this;
    }

    protected function getSemaphore(): SemaphoreInterface
    {
        if (!$this->hasSemaphore()) {
            throw new \LogicException('NeighborhoodsKojoSemaphore is not set.');
        }

        return $this->NeighborhoodsKojoSemaphore;
    }

    protected function hasSemaphore(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphore);
    }

    protected function unsetSemaphore(): self
    {
        if (!$this->hasSemaphore()) {
            throw new \LogicException('NeighborhoodsKojoSemaphore is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphore);

        return $this;
    }
}
