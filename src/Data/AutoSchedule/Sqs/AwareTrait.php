<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\AutoSchedule\Sqs;

use NHDS\Jobs\Data\AutoSchedule\SqsInterface;

trait AwareTrait
{
    public function setAutoScheduleSqs(SqsInterface $autoScheduleSqs)
    {
        $this->_create(SqsInterface::class, $autoScheduleSqs);

        return $this;
    }

    protected function _getAutoScheduleSqs(): SqsInterface
    {
        return $this->_read(SqsInterface::class);
    }

    protected function _getAutoScheduleSqsClone(): SqsInterface
    {
        return clone $this->_getAutoScheduleSqs();
    }

    protected function _hasAutoScheduleSqsClone(): bool
    {
        return $this->_exists(SqsInterface::class);
    }

    protected function _unsetAutoScheduleSqs()
    {
        $this->_delete(SqsInterface::class);

        return $this;
    }
}