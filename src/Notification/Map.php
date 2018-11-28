<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\NotificationInterface;

/**
 * @codeCoverageIgnore
 */
class Map extends \ArrayIterator implements MapInterface
{

    /**
     * @param \Neighborhoods\Kojo\NotificationInterface ...$AskNotifications
     */
    public function __construct(array $AskNotifications = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($AskNotifications)) {
            $this->assertValidArrayType(...array_values($AskNotifications));
        }

        parent::__construct($AskNotifications, $flags);
    }

    public function offsetGet($index) : \Neighborhoods\Kojo\NotificationInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $AskNotification
     */
    public function offsetSet($index, $AskNotification)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($AskNotification));
    }

    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $AskNotification
     */
    public function append($AskNotification)
    {
        $this->assertValidArrayItemType($AskNotification);
        parent::append($AskNotification);
    }

    public function current() : \Neighborhoods\Kojo\NotificationInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\Neighborhoods\Kojo\NotificationInterface $AskNotification)
    {
        return $AskNotification;
    }

    protected function assertValidArrayType(\Neighborhoods\Kojo\NotificationInterface ... $AskNotifications) : MapInterface
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

