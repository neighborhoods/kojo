<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger\Message;

use Neighborhoods\Kojo\Logger\MessageInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoLoggerMessage;

    public function setLoggerMessage(MessageInterface $loggerMessage): self
    {
        if ($this->hasLoggerMessage()) {
            throw new \LogicException('NeighborhoodsKojoLoggerMessage is already set.');
        }
        $this->NeighborhoodsKojoLoggerMessage = $loggerMessage;

        return $this;
    }

    protected function getLoggerMessage(): MessageInterface
    {
        if (!$this->hasLoggerMessage()) {
            throw new \LogicException('NeighborhoodsKojoLoggerMessage is not set.');
        }

        return $this->NeighborhoodsKojoLoggerMessage;
    }

    protected function hasLoggerMessage(): bool
    {
        return isset($this->NeighborhoodsKojoLoggerMessage);
    }

    protected function unsetLoggerMessage(): self
    {
        if (!$this->hasLoggerMessage()) {
            throw new \LogicException('NeighborhoodsKojoLoggerMessage is not set.');
        }
        unset($this->NeighborhoodsKojoLoggerMessage);

        return $this;
    }
}
