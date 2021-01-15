<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Pylon\Data\Property\Defensive;

class UserDefined implements UserDefinedInterface
{
    use Defensive\AwareTrait;
    const PROP_RESOURCE_NAME = 'resource_name';
    protected $resource_path;

    public function getResourceName(): string
    {
        if (!$this->_exists(self::PROP_RESOURCE_NAME)) {
            throw new \LogicException('Resource name is not set.');
        }

        return $this->_read(self::PROP_RESOURCE_NAME);
    }

    public function setResourceName(string $resourceName) : UserDefinedInterface
    {
        if ($this->_exists(self::PROP_RESOURCE_NAME)) {
            throw new \LogicException('Resource name is already set.');
        }

        $this->_create(self::PROP_RESOURCE_NAME, $resourceName);

        return $this;
    }

    public function getIsBlocking(): bool
    {
        return false;
    }

    public function setResourcePath(string $resourcePath): UserDefinedInterface
    {
        if ($this->resource_path === null) {
            $this->resource_path = $resourcePath;
        } else {
            throw new \LogicException('Resource path is already set.');
        }

        return $this;
    }

    public function getResourcePath(): string
    {
        if ($this->resource_path === null) {
            throw new \LogicException('Resource path is not set.');
        }

        return $this->resource_path;
    }
}
