<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria;

use Neighborhoods\Kojo\SearchCriteriaInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): SearchCriteriaInterface
    {
        return clone $this->getSearchCriteria();
    }
}
