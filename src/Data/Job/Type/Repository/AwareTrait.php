<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Type\Repository;

use NHDS\Jobs\Data\Job\Type\RepositoryInterface;

trait AwareTrait
{
    public function setJobTypeRepository(RepositoryInterface $jobTypeRepository)
    {
        $this->_create(RepositoryInterface::class, $jobTypeRepository);

        return $this;
    }

    protected function _getJobTypeRepository(): RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _getJobTypeRepositoryClone(): RepositoryInterface
    {
        return clone $this->_getJobTypeRepository();
    }
}