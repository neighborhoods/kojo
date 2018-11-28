<?php

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\NotificationInterface;
use Neighborhoods\Kojo\AskInterface; // "Root" level like SC was.

interface RepositoryInterface
{
    public function add(AskInterface $ask): RepositoryInterface;

    public function exists(AskInterface $ask): bool;

    public function get(AskInterface $ask): NotificationInterface;

    public function replace(AskInterface $ask): RepositoryInterface;

    public function remove(AskInterface $ask): RepositoryInterface;

    public function startTransaction(): RepositoryInterface;

    public function commit(): RepositoryInterface;

    public function rollback(): RepositoryInterface;
}
