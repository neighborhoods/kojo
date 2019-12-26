<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder;

    public function setProcessPoolLoggerMessageSerializableProcessFromArrayBuilder(FromArrayBuilderInterface $processPoolLoggerMessageSerializableProcessFromArrayBuilder) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder = $processPoolLoggerMessageSerializableProcessFromArrayBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFromArrayBuilder() : FromArrayBuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFromArrayBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilder);

        return $this;
    }
}
