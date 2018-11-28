<?php

namespace Neighborhoods\Kojo\Where\Builder\Factory;

use Neighborhoods\Kojo\Where\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WhereBuilderFactory;

    public function setWhereBuilderFactory(FactoryInterface $whereBuilderFactory): self
    {
        if ($this->hasWhereBuilderFactory()) {
            throw new \LogicException('WhereBuilderFactory is already set.');
        }
        $this->WhereBuilderFactory = $whereBuilderFactory;

        return $this;
    }

    protected function getWhereBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereBuilderFactory()) {
            throw new \LogicException('WhereBuilderFactory is not set.');
        }

        return $this->WhereBuilderFactory;
    }

    protected function hasWhereBuilderFactory(): bool
    {
        return isset($this->WhereBuilderFactory);
    }

    protected function unsetWhereBuilderFactory(): self
    {
        if (!$this->hasWhereBuilderFactory()) {
            throw new \LogicException('WhereBuilderFactory is not set.');
        }
        unset($this->WhereBuilderFactory);

        return $this;
    }
}
