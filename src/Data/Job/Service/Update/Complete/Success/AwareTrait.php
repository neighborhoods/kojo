<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Success;

use NHDS\Jobs\Data\Job\Service\Update\Complete\SuccessInterface;

trait AwareTrait
{
    public function setUpdateCompleteSuccess(SuccessInterface $updateCompleteSuccess)
    {
        $this->_create(SuccessInterface::class, $updateCompleteSuccess);

        return $this;
    }

    protected function _getUpdateCompleteSuccess(): SuccessInterface
    {
        return $this->_read(SuccessInterface::class);
    }

    protected function _getUpdateCompleteSuccessClone(): SuccessInterface
    {
        return clone $this->_getUpdateCompleteSuccess();
    }
}