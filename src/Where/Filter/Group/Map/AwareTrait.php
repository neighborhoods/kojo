<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map;

use Neighborhoods\Kojo\Where\Filter\Group\MapInterface;

trait AwareTrait
{
    protected $WhereFilterGroupMap = null;

    public function setWhereFilterGroupMap(MapInterface $WhereFilterGroupMap): self
    {
        if ($this->hasWhereFilterGroupMap()) {
            throw new \LogicException('WhereFilterGroupMap is already set.');
        }
        $this->WhereFilterGroupMap = $WhereFilterGroupMap;

        return $this;
    }

    protected function getWhereFilterGroupMap(): MapInterface
    {
        if (!$this->hasWhereFilterGroupMap()) {
            throw new \LogicException('WhereFilterGroupMap is not set.');
        }

        return $this->WhereFilterGroupMap;
    }

    protected function hasWhereFilterGroupMap(): bool
    {
        return isset($this->WhereFilterGroupMap);
    }

    protected function unsetWhereFilterGroupMap(): self
    {
        if (!$this->hasWhereFilterGroupMap()) {
            throw new \LogicException('WhereFilterGroupMap is not set.');
        }
        unset($this->WhereFilterGroupMap);

        return $this;
    }
}
