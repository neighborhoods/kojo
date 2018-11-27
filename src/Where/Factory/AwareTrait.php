<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Factory;

use Neighborhoods\Kojo\Where\FactoryInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereFactory;

    public function setWhereFactory(FactoryInterface $whereFactory): self
    {
        if ($this->hasWhereFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFactory is already set.');
        }
        $this->NeighborhoodsKojoWhereFactory = $whereFactory;

        return $this;
    }

    protected function getWhereFactory(): FactoryInterface
    {
        if (!$this->hasWhereFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFactory is not set.');
        }

        return $this->NeighborhoodsKojoWhereFactory;
    }

    protected function hasWhereFactory(): bool
    {
        return isset($this->NeighborhoodsKojoWhereFactory);
    }

    protected function unsetWhereFactory(): self
    {
        if (!$this->hasWhereFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFactory is not set.');
        }
        unset($this->NeighborhoodsKojoWhereFactory);

        return $this;
    }
}
