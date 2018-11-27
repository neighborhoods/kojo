<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map\Builder;

use Neighborhoods\Kojo\Where\Filter\Group\Map\BuilderInterface;

trait AwareTrait
{
    protected $WhereFilterGroupMapBuilder = null;

    public function setWhereFilterGroupMapBuilder(BuilderInterface $whereFilterGroupMapBuilder): self
    {
        if ($this->hasWhereFilterGroupMapBuilder()) {
            throw new \LogicException('WhereFilterGroupMapBuilder is already set.');
        }
        $this->WhereFilterGroupMapBuilder = $whereFilterGroupMapBuilder;

        return $this;
    }

    protected function getWhereFilterGroupMapBuilder(): BuilderInterface
    {
        if (!$this->hasWhereFilterGroupMapBuilder()) {
            throw new \LogicException('WhereFilterGroupMapBuilder is not set.');
        }

        return $this->WhereFilterGroupMapBuilder;
    }

    protected function hasWhereFilterGroupMapBuilder(): bool
    {
        return isset($this->WhereFilterGroupMapBuilder);
    }

    protected function unsetWhereFilterGroupMapBuilder(): self
    {
        if (!$this->hasWhereFilterGroupMapBuilder()) {
            throw new \LogicException('WhereFilterGroupMapBuilder is not set.');
        }
        unset($this->WhereFilterGroupMapBuilder);

        return $this;
    }
}
