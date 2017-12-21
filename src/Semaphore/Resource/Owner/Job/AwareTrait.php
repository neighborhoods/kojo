<?php

namespace NHDS\Jobs\Semaphore\Resource\Owner\Job;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Semaphore\Resource\Owner\Job;
use NHDS\Jobs\Semaphore\ResourceInterface;

trait AwareTrait
{
    protected function _getNewJobOwnerResource(JobInterface $job): ResourceInterface
    {
        /** @var ResourceInterface $jobSemaphoreResource */
        $jobSemaphoreResource = $this->_getNewSemaphoreResource('job');
        $resourceOwner = $jobSemaphoreResource->getResourceOwner();
        if ($resourceOwner instanceof Job) {
            $resourceOwner->setJob($job);
        }else {
            throw new \UnexpectedValueException('Resource owner is an unexpected type.');
        }

        return $jobSemaphoreResource;
    }
}