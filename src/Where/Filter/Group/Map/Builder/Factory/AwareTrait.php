<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map\Builder\Factory;

use Neighborhoods\Kojo\Where\Filter\Group\Map\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WhereFilterGroupMapBuilderFactory = null;

    public function setWhereFilterGroupMapBuilderFactory(FactoryInterface $whereFilterGroupMapBuilderFactory): self
    {
        if ($this->hasWhereFilterGroupMapBuilderFactory()) {
            throw new \LogicException('WhereFilterGroupMapBuilderFactory is already set.');
        }
        $this->WhereFilterGroupMapBuilderFactory = $whereFilterGroupMapBuilderFactory;

        return $this;
    }

    protected function getWhereFilterGroupMapBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterGroupMapBuilderFactory()) {
            throw new \LogicException('WhereFilterGroupMapBuilderFactory is not set.');
        }

        return $this->WhereFilterGroupMapBuilderFactory;
    }

    protected function hasWhereFilterGroupMapBuilderFactory(): bool
    {
        return isset($this->WhereFilterGroupMapBuilderFactory);
    }

    protected function unsetWhereFilterGroupMapBuilderFactory(): self
    {
        if (!$this->hasWhereFilterGroupMapBuilderFactory()) {
            throw new \LogicException('WhereFilterGroupMapBuilderFactory is not set.');
        }
        unset($this->WhereFilterGroupMapBuilderFactory);

        return $this;
    }
}

