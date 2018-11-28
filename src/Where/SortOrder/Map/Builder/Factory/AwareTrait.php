<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Map\Builder\Factory;

use Neighborhoods\Kojo\Where\SortOrder\Map\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WhereSortOrderMapBuilderFactory = null;

    public function setWhereSortOrderMapBuilderFactory(FactoryInterface $whereSortOrderMapBuilderFactory): self
    {
        if ($this->hasWhereSortOrderMapBuilderFactory()) {
            throw new \LogicException('WhereSortOrderMapBuilderFactory is already set.');
        }
        $this->WhereSortOrderMapBuilderFactory = $whereSortOrderMapBuilderFactory;

        return $this;
    }

    protected function getWhereSortOrderMapBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereSortOrderMapBuilderFactory()) {
            throw new \LogicException('WhereSortOrderMapBuilderFactory is not set.');
        }

        return $this->WhereSortOrderMapBuilderFactory;
    }

    protected function hasWhereSortOrderMapBuilderFactory(): bool
    {
        return isset($this->WhereSortOrderMapBuilderFactory);
    }

    protected function unsetWhereSortOrderMapBuilderFactory(): self
    {
        if (!$this->hasWhereSortOrderMapBuilderFactory()) {
            throw new \LogicException('WhereSortOrderMapBuilderFactory is not set.');
        }
        unset($this->WhereSortOrderMapBuilderFactory);

        return $this;
    }
}

