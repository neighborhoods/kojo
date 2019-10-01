<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Builder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory;

    public function setProcessPoolLoggerMessageBuilderFactory(
        FactoryInterface $ProcessPoolLoggerMessageBuilderFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory = $ProcessPoolLoggerMessageBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageBuilderFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageBuilderFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageBuilderFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageBuilderFactory);

        return $this;
    }
}
