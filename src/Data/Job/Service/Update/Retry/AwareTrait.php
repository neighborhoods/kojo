<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Retry;

use NHDS\Jobs\Data\Job\Service\Update\RetryInterface;

trait AwareTrait
{
    public function setUpdateRetry(RetryInterface $updateRetry)
    {
        $this->_create(RetryInterface::class, $updateRetry);

        return $this;
    }

    protected function _getUpdateRetry(): RetryInterface
    {
        return $this->_read(RetryInterface::class);
    }

    protected function _getUpdateRetryClone(): RetryInterface
    {
        return clone $this->_getUpdateRetry();
    }
}