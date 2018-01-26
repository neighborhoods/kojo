<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Collection\Delete;

use NHDS\Jobs\Data\Job\Collection\DeleteInterface;

trait AwareTrait
{
    public function setJobCollectionDelete(DeleteInterface $deleteCollection)
    {
        $this->_create(DeleteInterface::class, $deleteCollection);

        return $this;
    }

    public function hasJobCollectionDelete(): bool
    {
        return $this->_exists(DeleteInterface::class);
    }

    protected function _getJobCollectionDeleteClone(): DeleteInterface
    {
        return clone $this->_getJobCollectionDelete();
    }

    protected function _getJobCollectionDelete(): DeleteInterface
    {
        return $this->_read(DeleteInterface::class);
    }

    protected function _unsetJobCollectionDelete()
    {
        $this->_delete(DeleteInterface::class);

        return $this;
    }
}