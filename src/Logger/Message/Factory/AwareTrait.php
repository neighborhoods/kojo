<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger\Message\Factory;

use Neighborhoods\Kojo\Logger\Message\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoLoggerMessageFactory;

    public function setLoggerMessageFactory(FactoryInterface $loggerMessageFactory): self
    {
        if ($this->hasLoggerMessageFactory()) {
            throw new \LogicException('NeighborhoodsKojoLoggerMessageFactory is already set.');
        }
        $this->NeighborhoodsKojoLoggerMessageFactory = $loggerMessageFactory;

        return $this;
    }

    protected function getLoggerMessageFactory(): FactoryInterface
    {
        if (!$this->hasLoggerMessageFactory()) {
            throw new \LogicException('NeighborhoodsKojoLoggerMessageFactory is not set.');
        }

        return $this->NeighborhoodsKojoLoggerMessageFactory;
    }

    protected function hasLoggerMessageFactory(): bool
    {
        return isset($this->NeighborhoodsKojoLoggerMessageFactory);
    }

    protected function unsetLoggerMessageFactory(): self
    {
        if (!$this->hasLoggerMessageFactory()) {
            throw new \LogicException('NeighborhoodsKojoLoggerMessageFactory is not set.');
        }
        unset($this->NeighborhoodsKojoLoggerMessageFactory);

        return $this;
    }
}
