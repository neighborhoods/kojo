<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Retry\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Retry\FactoryInterface;

trait AwareTrait
{
    public function setUpdateRetryFactory(FactoryInterface $updateRetryFactory)
    {
        $this->_create(FactoryInterface::class, $updateRetryFactory);

        return $this;
    }

    protected function _getUpdateRetryFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}