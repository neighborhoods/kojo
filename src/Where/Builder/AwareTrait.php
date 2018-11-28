<?php

namespace Neighborhoods\Kojo\Where\Builder;

use Neighborhoods\Kojo\Where\BuilderInterface;

trait AwareTrait
{
    protected $WhereBuilder;

    public function setWhereBuilder(BuilderInterface $whereBuilder): self
    {
        if ($this->hasWhereBuilder()) {
            throw new \LogicException('WhereBuilder is already set.');
        }
        $this->WhereBuilder = $whereBuilder;

        return $this;
    }

    protected function getWhereBuilder(): BuilderInterface
    {
        if (!$this->hasWhereBuilder()) {
            throw new \LogicException('WhereBuilder is not set.');
        }

        return $this->WhereBuilder;
    }

    protected function hasWhereBuilder(): bool
    {
        return isset($this->WhereBuilder);
    }

    protected function unsetWhereBuilder(): self
    {
        if (!$this->hasWhereBuilder()) {
            throw new \LogicException('WhereBuilder is not set.');
        }
        unset($this->WhereBuilder);

        return $this;
    }
}
