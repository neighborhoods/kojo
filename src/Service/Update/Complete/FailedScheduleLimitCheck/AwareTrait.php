<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;

use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;
use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheckInterface;

trait AwareTrait
{
    public function setServiceUpdateCompleteFailedScheduleLimitCheck(
        FailedScheduleLimitCheckInterface $serviceUpdateCompleteFailedScheduleLimitCheck
    ){
        $this->_create(FailedScheduleLimitCheckInterface::class, $serviceUpdateCompleteFailedScheduleLimitCheck);

        return $this;
    }

    protected function _getServiceUpdateCompleteFailedScheduleLimitCheck(): FailedScheduleLimitCheckInterface
    {
        return $this->_read(FailedScheduleLimitCheckInterface::class);
    }

    protected function _getServiceUpdateCompleteFailedScheduleLimitCheckClone(): FailedScheduleLimitCheckInterface
    {
        return clone $this->_getServiceUpdateCompleteFailedScheduleLimitCheck();
    }

    protected function _unsetServiceUpdateCompleteFailedScheduleLimitCheck()
    {
        $this->_delete(FailedScheduleLimitCheck::class);

        return $this;
    }
}