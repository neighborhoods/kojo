<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Queue;

use Neighborhoods\KojoExample\Worker\QueueInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleWorkerQueue;

    public function setWorkerQueue(QueueInterface $workerQueue): self
    {
        assert(!$this->hasWorkerQueue(), new \LogicException('NeighborhoodsKojoExampleWorkerQueue is already set.'));
        $this->NeighborhoodsKojoExampleWorkerQueue = $workerQueue;

        return $this;
    }

    protected function getWorkerQueue(): QueueInterface
    {
        assert($this->hasWorkerQueue(), new \LogicException('NeighborhoodsKojoExampleWorkerQueue is not set.'));

        return $this->NeighborhoodsKojoExampleWorkerQueue;
    }

    protected function hasWorkerQueue(): bool
    {
        return isset($this->NeighborhoodsKojoExampleWorkerQueue);
    }

    protected function unsetWorkerQueue(): self
    {
        assert($this->hasWorkerQueue(), new \LogicException('NeighborhoodsKojoExampleWorkerQueue is not set.'));
        unset($this->NeighborhoodsKojoExampleWorkerQueue);

        return $this;
    }
}
