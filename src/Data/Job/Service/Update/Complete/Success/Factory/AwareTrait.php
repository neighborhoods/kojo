<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Success\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Complete\Success\FactoryInterface;

trait AwareTrait
{
    public function setUpdateCompleteSuccessFactory(FactoryInterface $updateCompleteSuccessFactory)
    {
        $this->_create(FactoryInterface::class, $updateCompleteSuccessFactory);

        return $this;
    }

    protected function _getUpdateCompleteSuccessFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}