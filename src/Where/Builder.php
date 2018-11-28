<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

use Neighborhoods\Kojo\WhereInterface;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Where\Factory\AwareTrait;
    use Where\Filter\Group\Map\Builder\Factory\AwareTrait;
    use Where\SortOrder\Map\Builder\Factory\AwareTrait;

    protected $from;

    public function build(): WhereInterface
    {
        $from = $this->getFrom();
        $where = $this->getWhereFactory()->create();
        $filterGroupMapBuilder = $this->getWhereFilterGroupMapBuilderFactory()->create();
        $filterGroupMapBuilder->setFrom($from['filter_groups']);
        $where->setWhereFilterGroupMap($filterGroupMapBuilder->build());
        $sortOrderMapBuilder = $this->getWhereSortOrderMapBuilderFactory()->create();
        $sortOrderMapBuilder->setFrom($from['sort_orders']);
        $where->setWhereSortOrderMap($sortOrderMapBuilder->build());
        $where->setCurrentPage($from['page_size']);
        $where->setCurrentPage($from['current_page']);

        return $where;
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
