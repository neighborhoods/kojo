<?php

namespace Neighborhoods\Kojo\Notification\Map;

use Neighborhoods\Kojo\Notification\MapInterface;
use Neighborhoods\Kojo\SearchCriteriaInterface;

interface RepositoryInterface
{
    public function add(MapInterface $map): RepositoryInterface;

    public function exists(MapInterface $map): bool;

    public function get(SearchCriteriaInterface $searchCriteria): MapInterface;

    public function replace(MapInterface $map): RepositoryInterface;

    public function remove(MapInterface $map): RepositoryInterface;

    public function startTransaction(): RepositoryInterface;

    public function commit(): RepositoryInterface;

    public function rollback(): RepositoryInterface;
}
