<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed;

use Neighborhoods\Kojo\Service\Update\Complete\FailedInterface;

trait AwareTrait
{
    public function setServiceUpdateCompleteFailed(FailedInterface $serviceUpdateCompleteFailed)
    {
        $this->_create(FailedInterface::class, $serviceUpdateCompleteFailed);

        return $this;
    }

    protected function _getServiceUpdateCompleteFailed(): FailedInterface
    {
        return $this->_read(FailedInterface::class);
    }

    protected function _getServiceUpdateCompleteFailedClone(): FailedInterface
    {
        return clone $this->_getServiceUpdateCompleteFailed();
    }

    protected function _unsetServiceUpdateCompleteFailed()
    {
        $this->_delete(FailedInterface::class);

        return $this;
    }
}