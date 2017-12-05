<?php

namespace NHDS\Jobs\Db\Model;

use Zend\Db\Sql\Select;

interface CollectionInterface extends \IteratorAggregate
{
    public function getSelect(): Select;

    public function getModelsArray(): array;

    public function getRecords(): array;
}