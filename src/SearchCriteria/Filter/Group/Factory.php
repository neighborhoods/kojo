<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface
    {
        return clone $this->getSearchCriteriaFilterGroup();
    }


}

