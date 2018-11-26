<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder\Map;

use Neighborhoods\Kojo\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getSearchCriteriaSortOrderMap()->getArrayCopy();
    }
}
