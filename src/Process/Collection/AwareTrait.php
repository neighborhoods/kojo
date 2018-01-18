<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Collection;

use NHDS\Jobs\Process\CollectionInterface;

trait AwareTrait
{
    public function setProcessCollection(CollectionInterface $collection)
    {
        $this->_create(CollectionInterface::class, $collection);

        return $this;
    }

    protected function _getProcessCollection(): CollectionInterface
    {
        return $this->_read(CollectionInterface::class);
    }
}