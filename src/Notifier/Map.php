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
     * @param \Neighborhoods\Kojo\NotifierInterface ...$AskNotifiers
     */
    public function __construct(array $AskNotifiers = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($AskNotifiers)) {
            $this->assertValidArrayType(...array_values($AskNotifiers));
        }

        parent::__construct($AskNotifiers, $flags);
    }

    public function offsetGet($index) : \Neighborhoods\Kojo\NotifierInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $AskNotifier
     */
    public function offsetSet($index, $AskNotifier)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($AskNotifier));
    }

    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $AskNotifier
     */
    public function append($AskNotifier)
    {
        $this->assertValidArrayItemType($AskNotifier);
        parent::append($AskNotifier);
    }

    public function current() : \Neighborhoods\Kojo\NotifierInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\Neighborhoods\Kojo\NotifierInterface $AskNotifier)
    {
        return $AskNotifier;
    }

    protected function assertValidArrayType(\Neighborhoods\Kojo\NotifierInterface ... $AskNotifiers) : MapInterface
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

