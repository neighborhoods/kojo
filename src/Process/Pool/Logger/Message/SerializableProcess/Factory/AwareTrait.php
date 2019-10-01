<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory;

    public function setProcessPoolLoggerMessageSerializableProcessFactory(
        FactoryInterface $ProcessPoolLoggerMessageSerializableProcessFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory = $ProcessPoolLoggerMessageSerializableProcessFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFactory);

        return $this;
    }
}
