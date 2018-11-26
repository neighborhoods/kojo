<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Builder;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\BuilderInterface
    {
        return clone $this->getSearchCriteriaFilterGroupMapBuilder();
    }


}

