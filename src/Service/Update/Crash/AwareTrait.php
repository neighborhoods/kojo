<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash;

use Neighborhoods\Kojo\Service\Update\CrashInterface;

trait AwareTrait
{
    public function setServiceUpdateCrash(CrashInterface $serviceUpdateCrash)
    {
        $this->_create(CrashInterface::class, $serviceUpdateCrash);

        return $this;
    }

    protected function _getServiceUpdateCrash(): CrashInterface
    {
        return $this->_read(CrashInterface::class);
    }

    protected function _getServiceUpdateCrashClone(): CrashInterface
    {
        return clone $this->_getServiceUpdateCrash();
    }

    protected function _unsetServiceUpdateCrash()
    {
        $this->_delete(CrashInterface::class);

        return $this;
    }
}