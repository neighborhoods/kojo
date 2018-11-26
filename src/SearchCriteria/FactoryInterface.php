<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria;

use Neighborhoods\Kojo\SearchCriteriaInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SearchCriteriaInterface;
}
