<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Hold;

use Neighborhoods\Kojo\Service\Update\HoldInterface;

trait AwareTrait
{
    public function setServiceUpdateHold(HoldInterface $serviceUpdateHold)
    {
        $this->_create(HoldInterface::class, $serviceUpdateHold);

        return $this;
    }

    protected function _getServiceUpdateHold(): HoldInterface
    {
        return $this->_read(HoldInterface::class);
    }

    protected function _getServiceUpdateHoldClone(): HoldInterface
    {
        return clone $this->_getServiceUpdateHold();
    }

    protected function _unsetServiceUpdateHold()
    {
        $this->_delete(HoldInterface::class);

        return $this;
    }
}