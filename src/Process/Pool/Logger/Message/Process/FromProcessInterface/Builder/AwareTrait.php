<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder;

    public function setProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder(
        BuilderInterface $ProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder = $ProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder(
    ) : BuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilder);

        return $this;
    }
}
