<?php

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\NotificationInterface;
use Neighborhoods\Kojo\SearchCriteriaInterface;
use Neighborhoods\Kojo\Notification;

class Repository implements RepositoryInterface
{
    use Notification\Builder\AwareTrait;

    public function get(SearchCriteriaInterface $searchCriteria): NotificationInterface
    {
        // TODO: Implement get() method.
        throw new \LogicException('Unimplemented get method.');

        return $this;
    }

    public function add(NotificationInterface $notification): RepositoryInterface
    {
        // TODO: Implement add() method.
        throw new \LogicException('Unimplemented add method.');

        return $this;
    }

    public function exists(NotificationInterface $notification): bool
    {
        // TODO: Implement exists() method.
        throw new \LogicException('Unimplemented exists method.');

        return $this;
    }

    public function replace(NotificationInterface $notification): RepositoryInterface
    {
        // TODO: Implement replace() method.
        throw new \LogicException('Unimplemented replace method.');

        return $this;
    }

    public function remove(NotificationInterface $notification): RepositoryInterface
    {
        // TODO: Implement remove() method.
        throw new \LogicException('Unimplemented remove method.');

        return $this;
    }

    public function startTransaction(): RepositoryInterface
    {
        // TODO: Implement startTransaction() method.
        throw new \LogicException('Unimplemented start transaction method.');

        return $this;
    }

    public function commit(): RepositoryInterface
    {
        // TODO: Implement commit() method.
        throw new \LogicException('Unimplemented commit method.');

        return $this;
    }

    public function rollback(): RepositoryInterface
    {
        // TODO: Implement rollback() method.
        throw new \LogicException('Unimplemented rollback method.');

        return $this;
    }
}
