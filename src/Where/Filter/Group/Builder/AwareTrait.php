<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Builder;

use Neighborhoods\Kojo\Where\Filter\Group\BuilderInterface;

trait AwareTrait
{
    protected $WhereFilterGroupBuilder = null;

    public function setWhereFilterGroupBuilder(BuilderInterface $WhereFilterGroupBuilder): self
    {
        if ($this->hasWhereFilterGroupBuilder()) {
            throw new \LogicException('WhereFilterGroupBuilder is already set.');
        }
        $this->WhereFilterGroupBuilder = $WhereFilterGroupBuilder;

        return $this;
    }

    protected function getWhereFilterGroupBuilder(): BuilderInterface
    {
        if (!$this->hasWhereFilterGroupBuilder()) {
            throw new \LogicException('WhereFilterGroupBuilder is not set.');
        }

        return $this->WhereFilterGroupBuilder;
    }

    protected function hasWhereFilterGroupBuilder(): bool
    {
        return isset($this->WhereFilterGroupBuilder);
    }

    protected function unsetWhereFilterGroupBuilder(): self
    {
        if (!$this->hasWhereFilterGroupBuilder()) {
            throw new \LogicException('WhereFilterGroupBuilder is not set.');
        }
        unset($this->WhereFilterGroupBuilder);

        return $this;
    }
}
