<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\NotificationInterface;

/**
 * @codeCoverageIgnore
 */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{

    /**
     * @param \Neighborhoods\Kojo\NotificationInterface ...$RETS1Notifications
     */
    public function __construct(array $RETS1Notifications = [], int $flags = 0);
    public function offsetGet($index) : \Neighborhoods\Kojo\NotificationInterface;
    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $RETS1Notification
     */
    public function offsetSet($index, $RETS1Notification);
    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $RETS1Notification
     */
    public function append($RETS1Notification);
    public function current() : \Neighborhoods\Kojo\NotificationInterface;
    public function getArrayCopy() : MapInterface;
    public function toArray() : array;
    public function hydrate(array $array) : MapInterface;

}

