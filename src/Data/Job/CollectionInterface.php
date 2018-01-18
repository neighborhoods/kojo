<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\Job\Collection\IteratorInterface;
use NHDS\Jobs\Db\Model;

interface CollectionInterface extends Model\CollectionInterface
{
    public function setIterator(IteratorInterface $iterator);

    public function getIterator(): IteratorInterface;
}