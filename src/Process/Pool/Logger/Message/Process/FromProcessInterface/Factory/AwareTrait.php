<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory;

    public function setProcessPoolLoggerMessageProcessFromProcessInterfaceFactory(
        FactoryInterface $ProcessPoolLoggerMessageProcessFromProcessInterfaceFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory = $ProcessPoolLoggerMessageProcessFromProcessInterfaceFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessInterfaceFactory(
    ) : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessInterfaceFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessInterfaceFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessInterfaceFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessInterfaceFactory);

        return $this;
    }
}
