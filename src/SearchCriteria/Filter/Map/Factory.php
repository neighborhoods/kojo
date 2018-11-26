<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Map;

use Neighborhoods\Kojo\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getSearchCriteriaFilterMap()->getArrayCopy();
    }
}
