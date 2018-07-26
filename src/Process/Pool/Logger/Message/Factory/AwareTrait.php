<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageFactory;

    public function setProcessPoolLoggerMessageFactory(FactoryInterface $processPoolLoggerMessageFactory) : self
    {
        assert(!$this->hasProcessPoolLoggerMessageFactory(),
               new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageFactory is already set.')
        );
        $this->NeighborhoodsKojoProcessPoolLoggerMessageFactory = $processPoolLoggerMessageFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageFactory() : FactoryInterface
    {
        assert($this->hasProcessPoolLoggerMessageFactory(),
               new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageFactory is not set.')
        );

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageFactory;
    }

    protected function hasProcessPoolLoggerMessageFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageFactory);
    }

    protected function unsetProcessPoolLoggerMessageFactory() : self
    {
        assert($this->hasProcessPoolLoggerMessageFactory(),
               new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageFactory is not set.')
        );
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageFactory);

        return $this;
    }
}
