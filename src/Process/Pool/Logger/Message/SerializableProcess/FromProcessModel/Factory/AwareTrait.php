<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory;

    public function setProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory(
        FactoryInterface $ProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory = $ProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory(
    ) : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelFactory);

        return $this;
    }
}
