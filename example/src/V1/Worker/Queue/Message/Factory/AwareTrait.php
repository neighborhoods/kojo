<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue\Message\Factory;

use Neighborhoods\KojoExample\V1\Worker\Queue\Message\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1WorkerQueueMessageFactory;

    public function setV1WorkerQueueMessageFactory(FactoryInterface $v1WorkerQueueMessageFactory): self
    {
        assert(!$this->hasV1WorkerQueueMessageFactory(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueueMessageFactory is already set.'));
        $this->NeighborhoodsKojoExampleV1WorkerQueueMessageFactory = $v1WorkerQueueMessageFactory;

        return $this;
    }

    protected function getV1WorkerQueueMessageFactory(): FactoryInterface
    {
        assert($this->hasV1WorkerQueueMessageFactory(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueueMessageFactory is not set.'));

        return $this->NeighborhoodsKojoExampleV1WorkerQueueMessageFactory;
    }

    protected function hasV1WorkerQueueMessageFactory(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1WorkerQueueMessageFactory);
    }

    protected function unsetV1WorkerQueueMessageFactory(): self
    {
        assert($this->hasV1WorkerQueueMessageFactory(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueueMessageFactory is not set.'));
        unset($this->NeighborhoodsKojoExampleV1WorkerQueueMessageFactory);

        return $this;
    }
}
