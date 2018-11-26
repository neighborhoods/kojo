<?php

namespace Neighborhoods\Kojo\Notifier\Map;

interface RepositoryInterface
{

    public function get(\Neighborhoods\Kojo\SearchCriteriaInterface $searchCriteria) : \Neighborhoods\Kojo\Notifier\MapInterface;
    public function add(\Neighborhoods\Kojo\Notifier\MapInterface $Map) : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface;
    public function exists(\Neighborhoods\Kojo\Notifier\MapInterface $Map) : bool;
    public function replace(\Neighborhoods\Kojo\Notifier\MapInterface $Map) : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface;
    public function remove(\Neighborhoods\Kojo\Notifier\MapInterface $Map) : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface;
    public function startTransaction() : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface;
    public function commit() : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface;
    public function rollback() : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface;

}

