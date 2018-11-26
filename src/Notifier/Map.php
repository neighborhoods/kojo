<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Notifier;

use Neighborhoods\Kojo\NotifierInterface;

/**
 * @codeCoverageIgnore
 */
class Map extends \ArrayIterator implements MapInterface
{

    /**
     * @param \Neighborhoods\Kojo\NotifierInterface ...$RETS1Notifiers
     */
    public function __construct(array $RETS1Notifiers = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($RETS1Notifiers)) {
            $this->assertValidArrayType(...array_values($RETS1Notifiers));
        }

        parent::__construct($RETS1Notifiers, $flags);
    }

    public function offsetGet($index) : \Neighborhoods\Kojo\NotifierInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $RETS1Notifier
     */
    public function offsetSet($index, $RETS1Notifier)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($RETS1Notifier));
    }

    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $RETS1Notifier
     */
    public function append($RETS1Notifier)
    {
        $this->assertValidArrayItemType($RETS1Notifier);
        parent::append($RETS1Notifier);
    }

    public function current() : \Neighborhoods\Kojo\NotifierInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\Neighborhoods\Kojo\NotifierInterface $RETS1Notifier)
    {
        return $RETS1Notifier;
    }

    protected function assertValidArrayType(\Neighborhoods\Kojo\NotifierInterface ... $RETS1Notifiers) : MapInterface
    {
        return $this;
    }

    public function getArrayCopy() : MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray() : array
    {
        return (array)$this;
    }

    public function hydrate(array $array) : MapInterface
    {
        $this->__construct($array);

        return $this;
    }


}

