<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Model;

use Neighborhoods\Kojo\Db\Connection\Container\RepositoryInterface;
use Zend\Db\Sql\Select;

interface CollectionInterface extends \IteratorAggregate
{
    public function setDbConnectionContainerRepository(RepositoryInterface $dbConnectionContainerRepository);

    public function getSelect(): Select;

    public function &getModelsArray(): array;

    public function &getRecords(): array;
}