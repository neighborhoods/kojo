<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory;

    public function setProcessPoolLoggerMessageProcessFromProcessModelFactory(
        FactoryInterface $ProcessPoolLoggerMessageProcessFromProcessModelFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessModelFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory = $ProcessPoolLoggerMessageProcessFromProcessModelFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessModelFactory(
    ) : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModelFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessModelFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessModelFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModelFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelFactory);

        return $this;
    }
}
