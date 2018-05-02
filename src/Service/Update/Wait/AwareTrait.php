<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Wait;

use Neighborhoods\Kojo\Service\Update\WaitInterface;

trait AwareTrait
{
    public function setServiceUpdateWait(WaitInterface $serviceUpdateWait)
    {
        $this->_create(WaitInterface::class, $serviceUpdateWait);

        return $this;
    }

    protected function _getServiceUpdateWait(): WaitInterface
    {
        return $this->_read(WaitInterface::class);
    }

    protected function _getServiceUpdateWaitClone(): WaitInterface
    {
        return clone $this->_getServiceUpdateWait();
    }

    protected function _unsetServiceUpdateWait()
    {
        $this->_delete(WaitInterface::class);

        return $this;
    }
}