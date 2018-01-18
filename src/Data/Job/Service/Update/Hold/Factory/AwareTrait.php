<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Hold\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Hold\FactoryInterface;

trait AwareTrait
{
    public function setUpdateHoldFactory(FactoryInterface $updateHoldFactory)
    {
        $this->_create(FactoryInterface::class, $updateHoldFactory);

        return $this;
    }

    protected function _getUpdateHoldFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}