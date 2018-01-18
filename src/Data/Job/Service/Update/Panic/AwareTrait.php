<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Panic;

use NHDS\Jobs\Data\Job\Service\Update\PanicInterface;

trait AwareTrait
{
    public function setJobServiceUpdatePanic(PanicInterface $jobServiceUpdatePanic)
    {
        $this->_create(PanicInterface::class, $jobServiceUpdatePanic);

        return $this;
    }

    protected function _getJobServiceUpdatePanic(): PanicInterface
    {
        return $this->_read(PanicInterface::class);
    }

    protected function _getJobServiceUpdatePanicClone(): PanicInterface
    {
        return clone $this->_getJobServiceUpdatePanic();
    }
}