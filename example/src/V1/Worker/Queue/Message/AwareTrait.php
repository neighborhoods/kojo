<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue\Message;

use Neighborhoods\KojoExample\V1\Worker\Queue\MessageInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1WorkerQueueMessage;

    public function setV1WorkerQueueMessage(MessageInterface $v1WorkerQueueMessage): self
    {
        assert(!$this->hasV1WorkerQueueMessage(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueueMessage is already set.'));
        $this->NeighborhoodsKojoExampleV1WorkerQueueMessage = $v1WorkerQueueMessage;

        return $this;
    }

    protected function getV1WorkerQueueMessage(): MessageInterface
    {
        assert($this->hasV1WorkerQueueMessage(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueueMessage is not set.'));

        return $this->NeighborhoodsKojoExampleV1WorkerQueueMessage;
    }

    protected function hasV1WorkerQueueMessage(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1WorkerQueueMessage);
    }

    protected function unsetV1WorkerQueueMessage(): self
    {
        assert($this->hasV1WorkerQueueMessage(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerQueueMessage is not set.'));
        unset($this->NeighborhoodsKojoExampleV1WorkerQueueMessage);

        return $this;
    }
}
