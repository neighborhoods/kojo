<?php

namespace NHDS\Jobs\Data\Job\Service\Create;

use NHDS\Jobs\Data\Job\Service\CreateInterface;

trait AwareTrait
{
    public function setJobServiceCreate(CreateInterface $create)
    {
        $this->_create(CreateInterface ::class, $create);

        return $this;
    }

    protected function _getJobServiceCreate(): CreateInterface
    {
        return $this->_read(CreateInterface ::class);
    }

    protected function _getJobServiceCreateClone(): CreateInterface
    {
        return clone $this->_getJobServiceCreate();
    }
}