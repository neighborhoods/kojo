<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria;

use Neighborhoods\Kojo\SearchCriteriaInterface;

class Builder implements BuilderInterface
{
    public function build(): SearchCriteriaInterface
    {

    }

    public function setRequirements(array $requirements): BuilderInterface
    {
        return $this;
    }

    protected function getRequirements(): array
    {

    }
}
