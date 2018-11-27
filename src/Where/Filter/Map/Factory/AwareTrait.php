<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Map\Factory;

use Neighborhoods\Kojo\Where\Filter\Map\FactoryInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereFilterMapFactory;

    public function setWhereFilterMapFactory(FactoryInterface $whereFilterMapFactory): self
    {
        if ($this->hasWhereFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterMapFactory is already set.');
        }
        $this->NeighborhoodsKojoWhereFilterMapFactory = $whereFilterMapFactory;

        return $this;
    }

    protected function getWhereFilterMapFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoWhereFilterMapFactory;
    }

    protected function hasWhereFilterMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoWhereFilterMapFactory);
    }

    protected function unsetWhereFilterMapFactory(): self
    {
        if (!$this->hasWhereFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoWhereFilterMapFactory);

        return $this;
    }
}
