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
     * @param \Neighborhoods\Kojo\NotificationInterface ...$RETS1Notifications
     */
    public function __construct(array $RETS1Notifications = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($RETS1Notifications)) {
            $this->assertValidArrayType(...array_values($RETS1Notifications));
        }

        parent::__construct($RETS1Notifications, $flags);
    }

    public function offsetGet($index) : \Neighborhoods\Kojo\NotificationInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $RETS1Notification
     */
    public function offsetSet($index, $RETS1Notification)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($RETS1Notification));
    }

    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $RETS1Notification
     */
    public function append($RETS1Notification)
    {
        $this->assertValidArrayItemType($RETS1Notification);
        parent::append($RETS1Notification);
    }

    public function current() : \Neighborhoods\Kojo\NotificationInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\Neighborhoods\Kojo\NotificationInterface $RETS1Notification)
    {
        return $RETS1Notification;
    }

    protected function assertValidArrayType(\Neighborhoods\Kojo\NotificationInterface ... $RETS1Notifications) : MapInterface
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

