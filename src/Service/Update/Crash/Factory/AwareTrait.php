<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash\Factory;

use Neighborhoods\Kojo\Service\Update\Crash\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateCrashFactory(FactoryInterface $serviceUpdateCrashFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateCrashFactory);

        return $this;
    }

    protected function _getServiceUpdateCrashFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateCrashFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}