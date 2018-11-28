<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Builder;

use Neighborhoods\Kojo\Where\SortOrder\BuilderInterface;

trait AwareTrait
{
    protected $WhereSortOrderBuilder;

    public function setWhereSortOrderBuilder(BuilderInterface $whereBuilder): self
    {
        if ($this->hasWhereSortOrderBuilder()) {
            throw new \LogicException('WhereSortOrderBuilder is already set.');
        }
        $this->WhereSortOrderBuilder = $whereBuilder;

        return $this;
    }

    protected function getWhereSortOrderBuilder(): BuilderInterface
    {
        if (!$this->hasWhereSortOrderBuilder()) {
            throw new \LogicException('WhereSortOrderBuilder is not set.');
        }

        return $this->WhereSortOrderBuilder;
    }

    protected function hasWhereSortOrderBuilder(): bool
    {
        return isset($this->WhereSortOrderBuilder);
    }

    protected function unsetWhereSortOrderBuilder(): self
    {
        if (!$this->hasWhereSortOrderBuilder()) {
            throw new \LogicException('WhereSortOrderBuilder is not set.');
        }
        unset($this->WhereSortOrderBuilder);

        return $this;
    }
}
