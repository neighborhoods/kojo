<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria;

use Neighborhoods\Kojo\SearchCriteriaInterface;

interface BuilderInterface
{
    public function build(): SearchCriteriaInterface;
}
