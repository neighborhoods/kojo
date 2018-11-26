<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface
    {
        return clone $this->getSearchCriteriaFilterGroupMap();
    }


}

