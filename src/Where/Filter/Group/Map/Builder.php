<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map;

use Neighborhoods\Kojo\Where;
use Neighborhoods\Kojo\Where\Filter\Group\MapInterface;

class Builder implements BuilderInterface
{
    use Where\Filter\Group\Map\Factory\AwareTrait;
    use Where\Filter\Group\Builder\Factory\AwareTrait;

    protected $from;

    public function build(): MapInterface
    {
        $map = $this->getWhereFilterGroupMapFactory()->create();
        foreach ($this->getFrom() as $filterGroupExpression) {
            $builder = $this->getWhereFilterGroupBuilderFactory()->create();
            $map[] = $builder->setFrom($filterGroupExpression)->build();
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
