<?php

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\NotificationInterface;
use Neighborhoods\Kojo\SearchCriteriaInterface;

interface RepositoryInterface
{
    public function add(NotificationInterface $notification): RepositoryInterface;

    public function exists(NotificationInterface $notification): bool;

    public function get(SearchCriteriaInterface $searchCriteria): NotificationInterface;

    public function replace(NotificationInterface $notification): RepositoryInterface;

    public function remove(NotificationInterface $notification): RepositoryInterface;

    public function startTransaction(): RepositoryInterface;

    public function commit(): RepositoryInterface;

    public function rollback(): RepositoryInterface;
}
