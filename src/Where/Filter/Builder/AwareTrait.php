<?php

namespace Neighborhoods\Kojo\Where\Filter\Builder;

use Neighborhoods\Kojo\Where\Filter\BuilderInterface;

trait AwareTrait
{
    protected $WhereFilterBuilder = null;

    public function setWhereFilterBuilder(BuilderInterface $whereFilterBuilder): self
    {
        if ($this->hasWhereFilterBuilder()) {
            throw new \LogicException('WhereFilterBuilder is already set.');
        }
        $this->WhereFilterBuilder = $whereFilterBuilder;

        return $this;
    }

    protected function getWhereFilterBuilder(): BuilderInterface
    {
        if (!$this->hasWhereFilterBuilder()) {
            throw new \LogicException('WhereFilterBuilder is not set.');
        }

        return $this->WhereFilterBuilder;
    }

    protected function hasWhereFilterBuilder(): bool
    {
        return isset($this->WhereFilterBuilder);
    }

    protected function unsetWhereFilterBuilder(): self
    {
        if (!$this->hasWhereFilterBuilder()) {
            throw new \LogicException('WhereFilterBuilder is not set.');
        }
        unset($this->WhereFilterBuilder);

        return $this;
    }
}
