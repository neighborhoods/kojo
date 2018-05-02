<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success\Factory;

use Neighborhoods\Kojo\Service\Update\Complete\Success\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateCompleteSuccessFactory(FactoryInterface $serviceUpdateCompleteSuccessFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateCompleteSuccessFactory);

        return $this;
    }

    protected function _getServiceUpdateCompleteSuccessFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateCompleteSuccessFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}