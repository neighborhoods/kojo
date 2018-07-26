<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema\Version;

use Neighborhoods\Kojo\Db\Schema\VersionInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param VersionInterface ...$versions */
    public function __construct(array $versions = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($versions)) {
            $this->assertValidArrayType(...array_values($versions));
        }

        parent::__construct($versions, $flags);
    }

    public function offsetGet($index): VersionInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param VersionInterface $version */
    public function offsetSet($index, $version)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($version));
    }

    /** @param VersionInterface $version */
    public function append($version)
    {
        $this->assertValidArrayItemType($version);
        parent::append($version);
    }

    public function current(): VersionInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(VersionInterface $version)
    {
        return $version;
    }

    protected function assertValidArrayType(VersionInterface ...$versions): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
