<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Panic\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Panic\FactoryInterface;

trait AwareTrait
{
    public function setJobServiceUpdatePanicFactory(FactoryInterface $updatePanicFactory)
    {
        $this->_create(FactoryInterface::class, $updatePanicFactory);

        return $this;
    }

    protected function _getJobServiceUpdatePanicFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}