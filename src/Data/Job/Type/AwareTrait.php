<?php
declare(strict_types=1);

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

    public function hasJobType(): bool
    {
        return $this->_exists(TypeInterface::class);
    }

    protected function _deleteJobType()
    {
        $this->_delete(TypeInterface::class);

        return $this;
    }
}