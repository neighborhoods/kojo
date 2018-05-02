<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Maintainer\Delete;

use Neighborhoods\Kojo\Maintainer\DeleteInterface;

trait AwareTrait
{
    public function setMaintainerDelete(DeleteInterface $delete)
    {
        $this->_create(DeleteInterface::class, $delete);

        return $this;
    }

    public function hasMaintainerDelete(): bool
    {
        return $this->_exists(DeleteInterface::class);
    }

    protected function _getMaintainerDeleteClone(): DeleteInterface
    {
        return clone $this->_getMaintainerDelete();
    }

    protected function _getMaintainerDelete(): DeleteInterface
    {
        return $this->_read(DeleteInterface::class);
    }

    protected function _unsetMaintainerDelete()
    {
        $this->_delete(DeleteInterface::class);

        return $this;
    }
}