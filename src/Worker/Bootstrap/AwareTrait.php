<?php

namespace NHDS\Jobs\Worker\Bootstrap;

use NHDS\Jobs\Worker\BootstrapInterface;

trait AwareTrait
{
    public function setBootstrap(BootstrapInterface $bootstrap)
    {
        $this->_create(BootstrapInterface::class, $bootstrap);

        return $this;
    }

    protected function _getBootstrap(): BootstrapInterface
    {
        return $this->_read(BootstrapInterface::class);
    }

    protected function _getBootstrapClone(): BootstrapInterface
    {
        return clone $this->_getBootstrap();
    }
}