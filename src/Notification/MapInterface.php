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
     * @param \Neighborhoods\Kojo\NotificationInterface ...$AskNotifications
     */
    public function __construct(array $AskNotifications = [], int $flags = 0);
    public function offsetGet($index) : \Neighborhoods\Kojo\NotificationInterface;
    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $AskNotification
     */
    public function offsetSet($index, $AskNotification);
    /**
     * @param \Neighborhoods\Kojo\NotificationInterface $AskNotification
     */
    public function append($AskNotification);
    public function current() : \Neighborhoods\Kojo\NotificationInterface;
    public function getArrayCopy() : MapInterface;
    public function toArray() : array;
    public function hydrate(array $array) : MapInterface;

}

