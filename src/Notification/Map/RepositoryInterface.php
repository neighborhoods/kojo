<?php

namespace Neighborhoods\Kojo\Notification\Map;

use Neighborhoods\Kojo\AskInterface;
use Neighborhoods\Kojo\Notification\MapInterface;

interface RepositoryInterface
{
    public function add(MapInterface $map): RepositoryInterface;

    public function exists(AskInterface $ask): bool;

    public function get(AskInterface $ask): MapInterface;

    public function replace(AskInterface $ask): RepositoryInterface;

    public function remove(AskInterface $ask): RepositoryInterface;

    public function startTransaction(): RepositoryInterface;

    public function commit(): RepositoryInterface;

    public function rollback(): RepositoryInterface;
}
