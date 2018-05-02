<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection\Delete;

use Neighborhoods\Kojo\Data\Job\Collection\DeleteInterface;

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