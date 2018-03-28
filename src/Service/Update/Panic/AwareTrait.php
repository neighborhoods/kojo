<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic;

use Neighborhoods\Kojo\Service\Update\PanicInterface;

trait AwareTrait
{
    public function setServiceUpdatePanic(PanicInterface $serviceUpdatePanic)
    {
        $this->_create(PanicInterface::class, $serviceUpdatePanic);

        return $this;
    }

    protected function _getServiceUpdatePanic(): PanicInterface
    {
        return $this->_read(PanicInterface::class);
    }

    protected function _getServiceUpdatePanicClone(): PanicInterface
    {
        return clone $this->_getServiceUpdatePanic();
    }

    protected function _unsetServiceUpdatePanic()
    {
        $this->_delete(PanicInterface::class);

        return $this;
    }
}