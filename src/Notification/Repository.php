<?php

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\AskInterface; // "Root" level like SC was.
use Neighborhoods\Kojo\NotificationInterface;
use Neighborhoods\Kojo\Notification;

class Repository implements RepositoryInterface
{
    use Notification\Builder\Repository\AwareTrait;
    use Notification\Factory\Repository\AwareTrait;

    public function get(AskInterface $ask): NotificationInterface
    {
        // TODO: Implement get() method.
        throw new \LogicException('Unimplemented get method.');

        return $this;
    }

    public function add(AskInterface $ask): RepositoryInterface
    {
        // TODO: Implement add() method.
        throw new \LogicException('Unimplemented add method.');

        return $this;
    }

    public function exists(AskInterface $ask): bool
    {
        // TODO: Implement exists() method.
        throw new \LogicException('Unimplemented exists method.');

        return $this;
    }

    public function replace(AskInterface $ask): RepositoryInterface
    {
        // TODO: Implement replace() method.
        throw new \LogicException('Unimplemented replace method.');

        return $this;
    }

    public function remove(AskInterface $ask): RepositoryInterface
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
