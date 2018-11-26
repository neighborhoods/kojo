<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Notifier;

use Neighborhoods\Kojo\NotifierInterface;

/**
 * @codeCoverageIgnore
 */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{

    /**
     * @param \Neighborhoods\Kojo\NotifierInterface ...$RETS1Notifiers
     */
    public function __construct(array $RETS1Notifiers = [], int $flags = 0);
    public function offsetGet($index) : \Neighborhoods\Kojo\NotifierInterface;
    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $RETS1Notifier
     */
    public function offsetSet($index, $RETS1Notifier);
    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $RETS1Notifier
     */
    public function append($RETS1Notifier);
    public function current() : \Neighborhoods\Kojo\NotifierInterface;
    public function getArrayCopy() : MapInterface;
    public function toArray() : array;
    public function hydrate(array $array) : MapInterface;

}

