<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder;

use Neighborhoods\Kojo\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): SortOrderInterface
    {
        return clone $this->getSearchCriteriaSortOrder();
    }
}
