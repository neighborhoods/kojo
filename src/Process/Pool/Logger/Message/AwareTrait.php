<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use Neighborhoods\Kojo\Process\Pool\Logger\MessageInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessage;

    public function setProcessPoolLoggerMessage(MessageInterface $processPoolLoggerMessage) : self
    {
        assert(!$this->hasProcessPoolLoggerMessage(),
               new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessage is already set.')
        );
        $this->NeighborhoodsKojoProcessPoolLoggerMessage = $processPoolLoggerMessage;

        return $this;
    }

    protected function getProcessPoolLoggerMessage() : MessageInterface
    {
        assert($this->hasProcessPoolLoggerMessage(),
               new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessage is not set.')
        );

        return $this->NeighborhoodsKojoProcessPoolLoggerMessage;
    }

    protected function hasProcessPoolLoggerMessage() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessage);
    }

    protected function unsetProcessPoolLoggerMessage() : self
    {
        assert($this->hasProcessPoolLoggerMessage(),
               new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessage is not set.')
        );
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessage);

        return $this;
    }
}
