<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Work;

use NHDS\Jobs\Data\Job\Service\Update\WorkInterface;

trait AwareTrait
{
    public function setJobServiceUpdateWork(WorkInterface $jobServiceUpdateWork)
    {
        $this->_create(WorkInterface::class, $jobServiceUpdateWork);

        return $this;
    }

    protected function _getJobServiceUpdateWork(): WorkInterface
    {
        return $this->_read(WorkInterface::class);
    }

    protected function _getJobServiceUpdateWorkClone(): WorkInterface
    {
        return clone $this->_getJobServiceUpdateWork();
    }
}