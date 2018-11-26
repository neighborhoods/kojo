<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter;

use Neighborhoods\Kojo\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): FilterInterface
    {
        return clone $this->getSearchCriteriaFilter();
    }
}
