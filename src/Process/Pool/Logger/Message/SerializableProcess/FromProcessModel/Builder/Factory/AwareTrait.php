<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\Builder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory;

    public function setProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory(
        FactoryInterface $ProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory = $ProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory(
    ) : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory(
    ) : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory);

        return $this;
    }
}
