<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param JobInterface ...$jobs */
    public function __construct(array $jobs = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($jobs)) {
            $this->assertValidArrayType(...array_values($jobs));
        }

        parent::__construct($jobs, $flags);
    }

    public function offsetGet($index): JobInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param JobInterface $job */
    public function offsetSet($index, $job)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($job));
    }

    /** @param JobInterface $job */
    public function append($job)
    {
        $this->assertValidArrayItemType($job);
        parent::append($job);
    }

    public function current(): JobInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(JobInterface $job)
    {
        return $job;
    }

    protected function assertValidArrayType(JobInterface ...$jobs): MapInterface
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
