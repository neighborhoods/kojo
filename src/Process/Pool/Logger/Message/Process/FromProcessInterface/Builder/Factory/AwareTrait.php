<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\Builder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory;

    public function setProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory(
        FactoryInterface $ProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory = $ProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory(
    ) : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory(
    ) : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceBuilderFactory);

        return $this;
    }
}
