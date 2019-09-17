<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory;

    public function setProcessPoolLoggerMessageProcessFactory(
        FactoryInterface $ProcessPoolLoggerMessageProcessFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory = $ProcessPoolLoggerMessageProcessFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory;
    }

    protected function hasProcessPoolLoggerMessageProcessFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory);
    }

    protected function unsetProcessPoolLoggerMessageProcessFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFactory);

        return $this;
    }
}
