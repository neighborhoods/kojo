<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Map\Builder;

use Neighborhoods\Kojo\Where\SortOrder\Map\BuilderInterface;

trait AwareTrait
{
    protected $WhereSortOrderMapBuilder = null;

    public function setWhereSortOrderMapBuilder(BuilderInterface $whereSortOrderMapBuilder): self
    {
        if ($this->hasWhereSortOrderMapBuilder()) {
            throw new \LogicException('WhereSortOrderMapBuilder is already set.');
        }
        $this->WhereSortOrderMapBuilder = $whereSortOrderMapBuilder;

        return $this;
    }

    protected function getWhereSortOrderMapBuilder(): BuilderInterface
    {
        if (!$this->hasWhereSortOrderMapBuilder()) {
            throw new \LogicException('WhereSortOrderMapBuilder is not set.');
        }

        return $this->WhereSortOrderMapBuilder;
    }

    protected function hasWhereSortOrderMapBuilder(): bool
    {
        return isset($this->WhereSortOrderMapBuilder);
    }

    protected function unsetWhereSortOrderMapBuilder(): self
    {
        if (!$this->hasWhereSortOrderMapBuilder()) {
            throw new \LogicException('WhereSortOrderMapBuilder is not set.');
        }
        unset($this->WhereSortOrderMapBuilder);

        return $this;
    }
}
