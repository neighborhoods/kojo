<?php

namespace NHDS\Jobs\Semaphore\Resource\Owner;

use NHDS\Jobs\Data;
use NHDS\Toolkit\Data\Property\Strict;

class Job implements JobInterface
{
    use Data\Job\AwareTrait;
    use Strict\AwareTrait;
    const PROP_RESOURCE_NAME = 'resource_name';
    const PROP_RESOURCE_PATH = 'resource_path';

    public function getResourceName(): string
    {
        if (!$this->_exists(self::PROP_RESOURCE_NAME)) {
            $resourceName = $this->_getJob()->getCanWorkInParallel() ? $this->_getJob()->getId() : 'job';
            $this->_create(self::PROP_RESOURCE_NAME, $resourceName);
        }

        return $this->_read(self::PROP_RESOURCE_NAME);
    }

    public function getResourcePath(): string
    {
        if (!$this->_exists(self::PROP_RESOURCE_PATH)) {
            $resourcePath = $this->_getJob()->getTypeCode();
            $this->_create(self::PROP_RESOURCE_PATH, $resourcePath);
        }

        return $this->_read(self::PROP_RESOURCE_PATH);
    }

    public function getIsBlocking(): bool
    {
        return false;
    }
}