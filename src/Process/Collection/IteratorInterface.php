<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Collection;

use Neighborhoods\Kojo\Process\CollectionInterface;
use Neighborhoods\Kojo\ProcessInterface;

interface IteratorInterface extends \Iterator
{
    public function setProcessCollection(CollectionInterface $collection);

    public function initialize(): IteratorInterface;

    function rewind();

    function current(): ProcessInterface;

    function key(): int;

    function next();

    function valid(): bool;
}