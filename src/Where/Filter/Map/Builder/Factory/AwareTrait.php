<?php

namespace Neighborhoods\Kojo\Where\Filter\Map\Builder\Factory;

use Neighborhoods\Kojo\Where\Filter\Map\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WhereFilterMapBuilderFactory = null;

    public function setWhereFilterMapBuilderFactory(FactoryInterface $whereFilterMapBuilderFactory): self
    {
        if ($this->hasWhereFilterMapBuilderFactory()) {
            throw new \LogicException('WhereFilterMapBuilderFactory is already set.');
        }
        $this->WhereFilterMapBuilderFactory = $whereFilterMapBuilderFactory;

        return $this;
    }

    protected function getWhereFilterMapBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterMapBuilderFactory()) {
            throw new \LogicException('WhereFilterMapBuilderFactory is not set.');
        }

        return $this->WhereFilterMapBuilderFactory;
    }

    protected function hasWhereFilterMapBuilderFactory(): bool
    {
        return isset($this->WhereFilterMapBuilderFactory);
    }

    protected function unsetWhereFilterMapBuilderFactory(): self
    {
        if (!$this->hasWhereFilterMapBuilderFactory()) {
            throw new \LogicException('WhereFilterMapBuilderFactory is not set.');
        }
        unset($this->WhereFilterMapBuilderFactory);

        return $this;
    }
}
