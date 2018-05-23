<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Model;

use Doctrine\DBAL\Query\QueryBuilder;

interface CollectionInterface extends \IteratorAggregate
{
    public function getQueryBuilder(): QueryBuilder;

    public function &getModelsArray(): array;

    public function &getRecords(): array;
}