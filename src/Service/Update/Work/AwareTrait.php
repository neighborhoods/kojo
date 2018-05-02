<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work;

use Neighborhoods\Kojo\Service\Update\WorkInterface;

trait AwareTrait
{
    public function setServiceUpdateWork(WorkInterface $serviceUpdateWork)
    {
        $this->_create(WorkInterface::class, $serviceUpdateWork);

        return $this;
    }

    protected function _getServiceUpdateWork(): WorkInterface
    {
        return $this->_read(WorkInterface::class);
    }

    protected function _getServiceUpdateWorkClone(): WorkInterface
    {
        return clone $this->_getServiceUpdateWork();
    }

    protected function _unsetServiceUpdateWork()
    {
        $this->_delete(WorkInterface::class);

        return $this;
    }
}