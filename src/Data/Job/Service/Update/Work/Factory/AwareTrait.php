<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Work\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Work\FactoryInterface;

trait AwareTrait
{
    public function setJobServiceUpdateWorkFactory(FactoryInterface $updateWorkFactory)
    {
        $this->_create(FactoryInterface::class, $updateWorkFactory);

        return $this;
    }

    protected function _getJobServiceUpdateWorkFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}