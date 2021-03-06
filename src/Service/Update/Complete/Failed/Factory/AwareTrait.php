<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed\Factory;

use Neighborhoods\Kojo\Service\Update\Complete\Failed\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateCompleteFailedFactory(FactoryInterface $serviceUpdateCompleteFailedFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateCompleteFailedFactory);

        return $this;
    }

    protected function _getServiceUpdateCompleteFailedFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateCompleteFailedFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}