<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder;

use Neighborhoods\Kojo\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SortOrderInterface;
}
