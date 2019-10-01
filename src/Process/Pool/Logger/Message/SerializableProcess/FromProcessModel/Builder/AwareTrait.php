<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder;

    public function setProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder(
        BuilderInterface $ProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder = $ProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder(
    ) : BuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilder);

        return $this;
    }
}
