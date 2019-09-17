<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder;

    public function setProcessPoolLoggerMessageProcessFromProcessModelBuilder(
        BuilderInterface $ProcessPoolLoggerMessageProcessFromProcessModelBuilder
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessModelBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder = $ProcessPoolLoggerMessageProcessFromProcessModelBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessModelBuilder(
    ) : BuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModelBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessModelBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessModelBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModelBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilder);

        return $this;
    }
}
