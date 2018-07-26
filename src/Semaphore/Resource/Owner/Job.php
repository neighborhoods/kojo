<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo;

class Job implements JobInterface
{
    use Kojo\Job\AwareTrait;

    protected $resourceName;
    protected $resourcePath;

    public function getResourceName(): string
    {
        if (!$this->resourceName === null) {
            $resourceName = $this->getJob()->getCanWorkInParallel() ? (string)$this->getJob()->getId() : 'job';
            $this->resourceName = $resourceName;
        }

        return $this->resourceName;
    }

    public function getResourcePath(): string
    {
        if (!$this->resourcePath === null) {
            $resourcePath = $this->getJob()->getTypeCode();
            $this->resourcePath = $resourcePath;
        }

        return $this->resourcePath;
    }

    public function getIsBlocking(): bool
    {
        return false;
    }
}