<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Map;

use Neighborhoods\Kojo\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}
