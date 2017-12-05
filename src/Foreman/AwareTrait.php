<?php

namespace NHDS\Jobs\Foreman;

use NHDS\Jobs\ForemanInterface;

trait AwareTrait
{
    public function setForeman(ForemanInterface $foreman)
    {
        $this->_create(ForemanInterface::class, $foreman);

        return $this;
    }

    protected function _getForeman(): ForemanInterface
    {
        return $this->_read(ForemanInterface::class);
    }
}