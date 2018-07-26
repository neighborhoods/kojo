<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Factory;

use Neighborhoods\Kojo\Process\Pool\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolFactory;

    public function setProcessPoolFactory(FactoryInterface $processPoolFactory): self
    {
        if ($this->hasProcessPoolFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolFactory = $processPoolFactory;

        return $this;
    }

    protected function getProcessPoolFactory(): FactoryInterface
    {
        if (!$this->hasProcessPoolFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolFactory;
    }

    protected function hasProcessPoolFactory(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolFactory);
    }

    protected function unsetProcessPoolFactory(): self
    {
        if (!$this->hasProcessPoolFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolFactory);

        return $this;
    }
}
