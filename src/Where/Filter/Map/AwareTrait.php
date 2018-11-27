<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Map;

use Neighborhoods\Kojo\Where\Filter\MapInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereFilterMap;

    public function setWhereFilterMap(MapInterface $whereFilterMap): self
    {
        if ($this->hasWhereFilterMap()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterMap is already set.');
        }
        $this->NeighborhoodsKojoWhereFilterMap = $whereFilterMap;

        return $this;
    }

    protected function getWhereFilterMap(): MapInterface
    {
        if (!$this->hasWhereFilterMap()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterMap is not set.');
        }

        return $this->NeighborhoodsKojoWhereFilterMap;
    }

    protected function hasWhereFilterMap(): bool
    {
        return isset($this->NeighborhoodsKojoWhereFilterMap);
    }

    protected function unsetWhereFilterMap(): self
    {
        if (!$this->hasWhereFilterMap()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilterMap is not set.');
        }
        unset($this->NeighborhoodsKojoWhereFilterMap);

        return $this;
    }
}
