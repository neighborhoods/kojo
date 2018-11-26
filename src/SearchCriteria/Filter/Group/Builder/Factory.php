<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Builder;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\BuilderInterface
    {
        return clone $this->getSearchCriteriaFilterGroupBuilder();
    }


}

