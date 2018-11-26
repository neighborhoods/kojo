<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter;

use Neighborhoods\Kojo\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): FilterInterface;
}
