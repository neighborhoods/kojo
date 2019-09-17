<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageBuilder;

    public function setProcessPoolLoggerMessageBuilder(
        BuilderInterface $ProcessPoolLoggerMessageBuilder
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageBuilder is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageBuilder = $ProcessPoolLoggerMessageBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageBuilder() : BuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageBuilder is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageBuilder;
    }

    protected function hasProcessPoolLoggerMessageBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageBuilder);
    }

    protected function unsetProcessPoolLoggerMessageBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageBuilder is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageBuilder);

        return $this;
    }
}
