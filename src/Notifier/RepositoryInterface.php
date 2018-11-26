<?php

namespace Neighborhoods\Kojo\Notifier;

interface RepositoryInterface
{

    public function get(\Neighborhoods\Kojo\SearchCriteriaInterface $searchCriteria) : \Neighborhoods\Kojo\NotifierInterface;
    public function add(\Neighborhoods\Kojo\NotifierInterface $Notifier) : \Neighborhoods\Kojo\Notifier\RepositoryInterface;
    public function exists(\Neighborhoods\Kojo\NotifierInterface $Notifier) : bool;
    public function replace(\Neighborhoods\Kojo\NotifierInterface $Notifier) : \Neighborhoods\Kojo\Notifier\RepositoryInterface;
    public function remove(\Neighborhoods\Kojo\NotifierInterface $Notifier) : \Neighborhoods\Kojo\Notifier\RepositoryInterface;
    public function startTransaction() : \Neighborhoods\Kojo\Notifier\RepositoryInterface;
    public function commit() : \Neighborhoods\Kojo\Notifier\RepositoryInterface;
    public function rollback() : \Neighborhoods\Kojo\Notifier\RepositoryInterface;

}

