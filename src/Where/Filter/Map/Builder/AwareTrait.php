<?php

namespace Neighborhoods\Kojo\Where\Filter\Map\Builder;

use Neighborhoods\Kojo\Where\Filter\Map\BuilderInterface;

trait AwareTrait
{
    protected $WhereFilterMapBuilder = null;

    public function setWhereFilterBuilder(BuilderInterface $whereFilterMapBuilder): self
    {
        if ($this->hasWhereFilterMapBuilder()) {
            throw new \LogicException('WhereFilterMapBuilder is already set.');
        }
        $this->WhereFilterMapBuilder = $whereFilterMapBuilder;

        return $this;
    }

    protected function getWhereFilterMapBuilder(): BuilderInterface
    {
        if (!$this->hasWhereFilterMapBuilder()) {
            throw new \LogicException('WhereFilterMapBuilder is not set.');
        }

        return $this->WhereFilterMapBuilder;
    }

    protected function hasWhereFilterMapBuilder(): bool
    {
        return isset($this->WhereFilterMapBuilder);
    }

    protected function unsetWhereFilterMapBuilder(): self
    {
        if (!$this->hasWhereFilterMapBuilder()) {
            throw new \LogicException('WhereFilterMapBuilder is not set.');
        }
        unset($this->WhereFilterMapBuilder);

        return $this;
    }
}
