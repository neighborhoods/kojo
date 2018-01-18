<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Hold;

use NHDS\Jobs\Data\Job\Service\Update\HoldInterface;

trait AwareTrait
{
    public function setUpdateHold(HoldInterface $updateHold)
    {
        $this->_create(HoldInterface::class, $updateHold);

        return $this;
    }

    protected function _getUpdateHold(): HoldInterface
    {
        return $this->_read(HoldInterface::class);
    }

    protected function _getUpdateHoldClone(): HoldInterface
    {
        return clone $this->_getUpdateHold();
    }
}