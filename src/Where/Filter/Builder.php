<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Where\Filter\Factory\AwareTrait;

    protected $from;

    public function build(): FilterInterface
    {
        $from = $this->getFrom();
        $filter = $this->getWhereFilterFactory()->create();
        $filter->setField($from['field']);
        $filter->setValues($from['values']);
        $filter->setCondition($from['condition_type']);

        return $filter;
    }

    protected function getFrom(): array
    {
        if ($this->from === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->from;
    }

    public function setFrom(array $from): BuilderInterface
    {
        if ($this->from !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->from = $from;

        return $this;
    }
}
