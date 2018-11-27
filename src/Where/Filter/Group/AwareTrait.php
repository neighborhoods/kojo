<?php

namespace Neighborhoods\Kojo\Where\Filter\Group;

trait AwareTrait
{
    protected $WhereFilterGroup = null;

    public function setWhereFilterGroup(\Neighborhoods\Kojo\Where\Filter\GroupInterface $whereFilterGroup): self
    {
        if ($this->hasWhereFilterGroup()) {
            throw new \LogicException('WhereFilterGroup is already set.');
        }
        $this->WhereFilterGroup = $whereFilterGroup;

        return $this;
    }

    protected function getWhereFilterGroup(): \Neighborhoods\Kojo\Where\Filter\GroupInterface
    {
        if (!$this->hasWhereFilterGroup()) {
            throw new \LogicException('WhereFilterGroup is not set.');
        }

        return $this->WhereFilterGroup;
    }

    protected function hasWhereFilterGroup(): bool
    {
        return isset($this->WhereFilterGroup);
    }

    protected function unsetWhereFilterGroup(): self
    {
        if (!$this->hasWhereFilterGroup()) {
            throw new \LogicException('WhereFilterGroup is not set.');
        }
        unset($this->WhereFilterGroup);

        return $this;
    }
}
