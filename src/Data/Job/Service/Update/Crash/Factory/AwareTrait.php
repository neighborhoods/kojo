<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Crash\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Crash\FactoryInterface;

trait AwareTrait
{
    public function setJobServiceUpdateCrashFactory(FactoryInterface $updateCrashFactory)
    {
        $this->_create(FactoryInterface::class, $updateCrashFactory);

        return $this;
    }

    protected function _getJobServiceUpdateCrashFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}