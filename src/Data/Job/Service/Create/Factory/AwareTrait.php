<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Create\Factory;

use NHDS\Jobs\Data\Job\Service\Create\FactoryInterface;

trait AwareTrait
{
    public function setJobServiceCreateFactory(FactoryInterface $updateCrashFactory)
    {
        $this->_create(FactoryInterface::class, $updateCrashFactory);

        return $this;
    }

    protected function _getJobServiceCreateFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}