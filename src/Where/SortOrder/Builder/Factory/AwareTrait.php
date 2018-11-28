<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Builder\Factory;

use Neighborhoods\Kojo\Where\SortOrder\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WhereSortOrderBuilderFactory;

    public function setWhereSortOrderBuilderFactory(FactoryInterface $whereSortOrderBuilderFactory): self
    {
        if ($this->hasWhereSortOrderBuilderFactory()) {
            throw new \LogicException('WhereSortOrderBuilderFactory is already set.');
        }
        $this->WhereSortOrderBuilderFactory = $whereSortOrderBuilderFactory;

        return $this;
    }

    protected function getWhereSortOrderBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereSortOrderBuilderFactory()) {
            throw new \LogicException('WhereSortOrderBuilderFactory is not set.');
        }

        return $this->WhereSortOrderBuilderFactory;
    }

    protected function hasWhereSortOrderBuilderFactory(): bool
    {
        return isset($this->WhereSortOrderBuilderFactory);
    }

    protected function unsetWhereSortOrderBuilderFactory(): self
    {
        if (!$this->hasWhereSortOrderBuilderFactory()) {
            throw new \LogicException('WhereSortOrderBuilderFactory is not set.');
        }
        unset($this->WhereSortOrderBuilderFactory);

        return $this;
    }
}
