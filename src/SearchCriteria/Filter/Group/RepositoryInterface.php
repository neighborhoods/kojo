<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

interface RepositoryInterface
{

    public function get(\Neighborhoods\Kojo\SearchCriteriaInterface $searchCriteria) : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface;
    public function add(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $Group) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface;
    public function exists(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $Group) : bool;
    public function replace(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $Group) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface;
    public function remove(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $Group) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface;
    public function startTransaction() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface;
    public function commit() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface;
    public function rollback() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface;

}

