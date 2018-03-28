<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Retry;

use Neighborhoods\Kojo\Service\Update\RetryInterface;

trait AwareTrait
{
    public function setServiceUpdateRetry(RetryInterface $serviceUpdateRetry)
    {
        $this->_create(RetryInterface::class, $serviceUpdateRetry);

        return $this;
    }

    protected function _getServiceUpdateRetry(): RetryInterface
    {
        return $this->_read(RetryInterface::class);
    }

    protected function _getServiceUpdateRetryClone(): RetryInterface
    {
        return clone $this->_getServiceUpdateRetry();
    }

    protected function _unsetServiceUpdateRetry()
    {
        $this->_delete(RetryInterface::class);

        return $this;
    }
}