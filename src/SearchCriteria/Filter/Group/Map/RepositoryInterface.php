<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map;

interface RepositoryInterface
{

    public function get(\Neighborhoods\Kojo\SearchCriteriaInterface $searchCriteria) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface;
    public function add(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface $Map) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface;
    public function exists(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface $Map) : bool;
    public function replace(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface $Map) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface;
    public function remove(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface $Map) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface;
    public function startTransaction() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface;
    public function commit() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface;
    public function rollback() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface;

}

