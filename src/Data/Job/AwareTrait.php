<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job;

use Neighborhoods\Kojo\Data\JobInterface;

trait AwareTrait
{
    public function setJob(JobInterface $job)
    {
        $this->_create(JobInterface::class, $job);

        return $this;
    }

    protected function _getJob(): JobInterface
    {
        return $this->_read(JobInterface::class);
    }

    protected function _getJobClone(): JobInterface
    {
        return clone $this->_getJob();
    }

    protected function _hasJob(): bool
    {
        return $this->_exists(JobInterface::class);
    }

    protected function _unsetJob()
    {
        $this->_delete(JobInterface::class);

        return $this;
    }
}