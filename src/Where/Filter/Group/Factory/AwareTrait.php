<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Factory;

use Neighborhoods\Kojo\Where\Filter\Group\FactoryInterface;

trait AwareTrait
{
    protected $WhereFilterGroupFactory = null;

    public function setWhereFilterGroupFactory(FactoryInterface $WhereFilterGroupFactory): self
    {
        if ($this->hasWhereFilterGroupFactory()) {
            throw new \LogicException('WhereFilterGroupFactory is already set.');
        }
        $this->WhereFilterGroupFactory = $WhereFilterGroupFactory;

        return $this;
    }

    protected function getWhereFilterGroupFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterGroupFactory()) {
            throw new \LogicException('WhereFilterGroupFactory is not set.');
        }

        return $this->WhereFilterGroupFactory;
    }

    protected function hasWhereFilterGroupFactory(): bool
    {
        return isset($this->WhereFilterGroupFactory);
    }

    protected function unsetWhereFilterGroupFactory(): self
    {
        if (!$this->hasWhereFilterGroupFactory()) {
            throw new \LogicException('WhereFilterGroupFactory is not set.');
        }
        unset($this->WhereFilterGroupFactory);

        return $this;
    }
}
