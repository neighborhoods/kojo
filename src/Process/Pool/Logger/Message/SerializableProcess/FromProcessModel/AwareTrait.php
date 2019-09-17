<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModelInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel;

    public function setProcessPoolLoggerMessageProcessFromProcessModel(
        FromProcessModelInterface $ProcessPoolLoggerMessageProcessFromProcessModel
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessModel()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel = $ProcessPoolLoggerMessageProcessFromProcessModel;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessModel(
    ) : FromProcessModelInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModel()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessModel() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessModel() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModel()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModel);

        return $this;
    }
}
