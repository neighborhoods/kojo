<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection\CrashDetection;

use Neighborhoods\Kojo\Data\Job\Collection\CrashDetectionInterface;

trait AwareTrait
{
    public function setJobCollectionCrashDetection(CrashDetectionInterface $jobCollectionCrashDetection)
    {
        $this->_create(CrashDetectionInterface::class, $jobCollectionCrashDetection);

        return $this;
    }

    protected function _getJobCollectionCrashDetection(): CrashDetectionInterface
    {
        return $this->_read(CrashDetectionInterface::class);
    }

    protected function _getJobCollectionCrashDetectionClone(): CrashDetectionInterface
    {
        return clone $this->_getJobCollectionCrashDetection();
    }
}