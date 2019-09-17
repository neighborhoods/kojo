<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\Builder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory;

    public function setProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory(
        FactoryInterface $ProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory = $ProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory(
    ) : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory(
    ) : self
    {
        if (!$this->hasProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageProcessFromProcessModelBuilderFactory);

        return $this;
    }
}
