<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

use Neighborhoods\KojoExample\V1\Worker\QueueInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1WorkerQueue;

    public function setV1WorkerQueue(QueueInterface $v1WorkerQueue): self
    {
        assert(!$this->hasV1WorkerQueue(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueue is already set.'));
        $this->NeighborhoodsKojoExampleV1WorkerQueue = $v1WorkerQueue;

        return $this;
    }

    protected function getV1WorkerQueue(): QueueInterface
    {
        assert($this->hasV1WorkerQueue(), new \LogicException('NeighborhoodsKojoExampleV1WorkerQueue is not set.'));

        return $this->NeighborhoodsKojoExampleV1WorkerQueue;
    }

    protected function hasV1WorkerQueue(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1WorkerQueue);
    }

    protected function unsetV1WorkerQueue(): self
    {
        assert($this->hasV1WorkerQueue(), new \LogicException('NeighborhoodsKojoExampleV1WorkerQueue is not set.'));
        unset($this->NeighborhoodsKojoExampleV1WorkerQueue);

        return $this;
    }
}
