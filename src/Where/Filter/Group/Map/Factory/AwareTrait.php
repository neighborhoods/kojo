<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map\Factory;

use Neighborhoods\Kojo\Where\Filter\Group\Map\FactoryInterface;

trait AwareTrait
{
    protected $WhereFilterGroupMapFactory = null;

    public function setWhereFilterGroupMapFactory(FactoryInterface $whereFilterGroupMapFactory): self
    {
        if ($this->hasWhereFilterGroupMapFactory()) {
            throw new \LogicException('WhereFilterGroupMapFactory is already set.');
        }
        $this->WhereFilterGroupMapFactory = $whereFilterGroupMapFactory;

        return $this;
    }

    protected function getWhereFilterGroupMapFactory(): FactoryInterface
    {
        if (!$this->hasWhereFilterGroupMapFactory()) {
            throw new \LogicException('WhereFilterGroupMapFactory is not set.');
        }

        return $this->WhereFilterGroupMapFactory;
    }

    protected function hasWhereFilterGroupMapFactory(): bool
    {
        return isset($this->WhereFilterGroupMapFactory);
    }

    protected function unsetWhereFilterGroupMapFactory(): self
    {
        if (!$this->hasWhereFilterGroupMapFactory()) {
            throw new \LogicException('WhereFilterGroupMapFactory is not set.');
        }
        unset($this->WhereFilterGroupMapFactory);

        return $this;
    }
}
