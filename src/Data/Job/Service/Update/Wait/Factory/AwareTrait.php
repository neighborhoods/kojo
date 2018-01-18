<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Wait\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Wait\FactoryInterface;

trait AwareTrait
{
    public function setJobServiceUpdateWaitFactory(FactoryInterface $updateWaitFactory)
    {
        $this->_create(FactoryInterface::class, $updateWaitFactory);

        return $this;
    }

    protected function _getJobServiceUpdateWaitFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}