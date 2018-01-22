<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\Success;

use NHDS\Jobs\Service\Update\Complete\SuccessInterface;

trait AwareTrait
{
    public function setServiceUpdateCompleteSuccess(SuccessInterface $serviceUpdateCompleteSuccess)
    {
        $this->_create(SuccessInterface::class, $serviceUpdateCompleteSuccess);

        return $this;
    }

    protected function _getServiceUpdateCompleteSuccess(): SuccessInterface
    {
        return $this->_read(SuccessInterface::class);
    }

    protected function _getServiceUpdateCompleteSuccessClone(): SuccessInterface
    {
        return clone $this->_getServiceUpdateCompleteSuccess();
    }

    protected function _unsetServiceUpdateCompleteSuccess()
    {
        $this->_delete(SuccessInterface::class);

        return $this;
    }
}