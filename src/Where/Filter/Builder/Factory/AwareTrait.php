<?php

namespace Neighborhoods\Kojo\Where\Filter\Builder\Factory;

use Neighborhoods\Kojo\Where\Filter\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WhereFilterBuilderFactory = null;

    public function setWhereFilterBuilderFactory(FactoryInterface $WhereFilterBuilderFactory): self
    {
        if ($this->hasWhereFilterBuilderFactory()) {
            throw new \LogicException('WhereFilterBuilderFactory is already set.');
        }
        $this->WhereFilterBuilderFactory = $WhereFilterBuilderFactory;

        return $this;
    }

    protected function getWhereFilterBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterBuilderFactory()) {
            throw new \LogicException('WhereFilterBuilderFactory is not set.');
        }

        return $this->WhereFilterBuilderFactory;
    }

    protected function hasWhereFilterBuilderFactory(): bool
    {
        return isset($this->WhereFilterBuilderFactory);
    }

    protected function unsetWhereFilterBuilderFactory(): self
    {
        if (!$this->hasWhereFilterBuilderFactory()) {
            throw new \LogicException('WhereFilterBuilderFactory is not set.');
        }
        unset($this->WhereFilterBuilderFactory);

        return $this;
    }
}
