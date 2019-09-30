<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModelInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel;

    public function setProcessPoolLoggerMessageSerializableProcessFromProcessModel(
        FromProcessModelInterface $ProcessPoolLoggerMessageSerializableProcessFromProcessModel
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModel()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel = $ProcessPoolLoggerMessageSerializableProcessFromProcessModel;

        return $this;
    }

    protected function getProcessPoolLoggerMessageSerializableProcessFromProcessModel(
    ) : FromProcessModelInterface
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModel()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel;
    }

    protected function hasProcessPoolLoggerMessageSerializableProcessFromProcessModel() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel);
    }

    protected function unsetProcessPoolLoggerMessageSerializableProcessFromProcessModel() : self
    {
        if (!$this->hasProcessPoolLoggerMessageSerializableProcessFromProcessModel()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageSerializableProcessFromProcessModel);

        return $this;
    }
}
