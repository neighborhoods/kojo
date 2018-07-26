<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Map\Factory;

use Neighborhoods\Kojo\Process\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessMapFactory;

    public function setProcessMapFactory(FactoryInterface $processMapFactory): self
    {
        if ($this->hasProcessMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessMapFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessMapFactory = $processMapFactory;

        return $this;
    }

    protected function getProcessMapFactory(): FactoryInterface
    {
        if (!$this->hasProcessMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessMapFactory;
    }

    protected function hasProcessMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoProcessMapFactory);
    }

    protected function unsetProcessMapFactory(): self
    {
        if (!$this->hasProcessMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessMapFactory);

        return $this;
    }
}
