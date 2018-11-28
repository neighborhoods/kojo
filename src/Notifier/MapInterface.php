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
     * @param \Neighborhoods\Kojo\NotifierInterface ...$AskNotifiers
     */
    public function __construct(array $AskNotifiers = [], int $flags = 0);
    public function offsetGet($index) : \Neighborhoods\Kojo\NotifierInterface;
    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $AskNotifier
     */
    public function offsetSet($index, $AskNotifier);
    /**
     * @param \Neighborhoods\Kojo\NotifierInterface $AskNotifier
     */
    public function append($AskNotifier);
    public function current() : \Neighborhoods\Kojo\NotifierInterface;
    public function getArrayCopy() : MapInterface;
    public function toArray() : array;
    public function hydrate(array $array) : MapInterface;

}

