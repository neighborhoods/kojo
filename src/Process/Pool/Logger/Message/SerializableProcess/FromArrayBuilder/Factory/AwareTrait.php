<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromArrayBuilder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromArrayBuilder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory;

    public function setProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory(FactoryInterface $processPoolLoggerMessageSerializableProcessFromArrayBuilderFactory) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory = $processPoolLoggerMessageSerializableProcessFromArrayBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory);

        return $this;
    }
}
