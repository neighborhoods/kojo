<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success;

use Neighborhoods\Kojo\Service\Update\Complete\SuccessInterface;

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