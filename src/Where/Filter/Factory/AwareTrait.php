<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Factory;

use Neighborhoods\Kojo\Where\Filter\FactoryInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereFilterFactory;

    public function setWhereFilterFactory(FactoryInterface $whereFilterFactory): self
    {
        if ($this->hasWhereFilterFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterFactory is already set.');
        }
        $this->NeighborhoodsKojoWhereFilterFactory = $whereFilterFactory;

        return $this;
    }

    protected function getWhereFilterFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterFactory is not set.');
        }

        return $this->NeighborhoodsKojoWhereFilterFactory;
    }

    protected function hasWhereFilterFactory(): bool
    {
        return isset($this->NeighborhoodsKojoWhereFilterFactory);
    }

    protected function unsetWhereFilterFactory(): self
    {
        if (!$this->hasWhereFilterFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterFactory is not set.');
        }
        unset($this->NeighborhoodsKojoWhereFilterFactory);

        return $this;
    }
}
