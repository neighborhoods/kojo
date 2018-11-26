<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

interface BuilderInterface
{

    public function build() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface;
    public function setRecord(array $record) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\BuilderInterface;

}

