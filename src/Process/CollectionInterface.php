<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Collection\IteratorInterface;
use Neighborhoods\Kojo\ProcessInterface;

interface CollectionInterface extends \IteratorAggregate
{
    public function addProcessPrototype(ProcessInterface $process): CollectionInterface;

    public function getProcessPrototypes(): array;

    public function setIterator(IteratorInterface $iterator);

    public function getIterator(): IteratorInterface;

    public function getProcessPrototypeClone(string $typeCode): ProcessInterface;

    public function applyProcessPool(PoolInterface $pool): CollectionInterface;
}