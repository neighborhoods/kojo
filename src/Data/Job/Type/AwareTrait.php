<?php

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job\TypeInterface;

trait AwareTrait
{
    public function setJobType(TypeInterface $job)
    {
        $this->_create(TypeInterface::class, $job);

        return $this;
    }

    protected function _getJobType(): TypeInterface
    {
        return $this->_read(TypeInterface::class);
    }

    protected function _getJobTypeClone(): TypeInterface
    {
        return clone $this->_getJobType();
    }
}