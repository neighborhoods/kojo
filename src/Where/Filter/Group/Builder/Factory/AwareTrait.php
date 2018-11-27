<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Builder\Factory;

use Neighborhoods\Kojo\Where\Filter\Group\Builder\FactoryInterface;

trait AwareTrait
{

    protected $WhereFilterGroupBuilderFactory = null;

    public function setWhereFilterGroupBuilderFactory(FactoryInterface $WhereFilterGroupBuilderFactory): self
    {
        if ($this->hasWhereFilterGroupBuilderFactory()) {
            throw new \LogicException('WhereFilterGroupBuilderFactory is already set.');
        }
        $this->WhereFilterGroupBuilderFactory = $WhereFilterGroupBuilderFactory;

        return $this;
    }

    protected function getWhereFilterGroupBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterGroupBuilderFactory()) {
            throw new \LogicException('WhereFilterGroupBuilderFactory is not set.');
        }

        return $this->WhereFilterGroupBuilderFactory;
    }

    protected function hasWhereFilterGroupBuilderFactory(): bool
    {
        return isset($this->WhereFilterGroupBuilderFactory);
    }

    protected function unsetWhereFilterGroupBuilderFactory(): self
    {
        if (!$this->hasWhereFilterGroupBuilderFactory()) {
            throw new \LogicException('WhereFilterGroupBuilderFactory is not set.');
        }
        unset($this->WhereFilterGroupBuilderFactory);

        return $this;
    }
}
