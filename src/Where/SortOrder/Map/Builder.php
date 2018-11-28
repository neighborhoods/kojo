<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Map;

use Neighborhoods\Kojo\Where;
use Neighborhoods\Kojo\Where\SortOrder\MapInterface;

class Builder implements BuilderInterface
{
    use Where\SortOrder\Map\Factory\AwareTrait;
    use Where\SortOrder\Builder\Factory\AwareTrait;

    protected $from;

    public function build(): MapInterface
    {
        $map = $this->getWhereSortOrderMapFactory()->create();
        foreach ($this->getFrom() as $from) {
            $builder = $this->getWhereSortOrderBuilderFactory()->create();
            $sortOrder = $builder->setFrom($from)->build();
            $map[] = $sortOrder;
        }

        return $map;
    }

    protected function getFrom(): array
    {
        if ($this->from === null) {
            throw new \LogicException('Builder from has not been set.');
        }

        return $this->from;
    }

    public function setFrom(array $from): BuilderInterface
    {
        if ($this->from !== null) {
            throw new \LogicException('Builder from is already set.');
        }

        $this->from = $from;

        return $this;
    }
}
