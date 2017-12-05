<?php

namespace NHDS\Jobs\Process\Type\Job\Bootstrap;

use NHDS\Jobs\Process\Type\Job\BootstrapInterface;

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