<?php

namespace Neighborhoods\Kojo\Where\Filter\Map;

use Neighborhoods\Kojo\Where;
use Neighborhoods\Kojo\Where\Filter\MapInterface;

class Builder implements BuilderInterface
{
    use Where\Filter\Map\Factory\AwareTrait;
    use Where\Filter\Builder\Factory\AwareTrait;

    protected $from;

    public function build(): MapInterface
    {
        $map = $this->getWhereFilterMapFactory()->create();
        foreach ($this->getFrom() as $filterExpression) {
            $builder = $this->getWhereFilterBuilderFactory()->create();
            $map[] = $builder->setFrom($filterExpression)->build();
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
