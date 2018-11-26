<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map;

interface BuilderInterface
{

    public function build() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface;
    public function setRecords(array $record) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\BuilderInterface;

}

