<?php

namespace NHDS\Jobs\Process\Collection;

use NHDS\Jobs\ProcessInterface;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Process\Collection;

class Iterator implements IteratorInterface
{
    use Strict\AwareTrait;
    use Collection\AwareTrait;
    protected $processPrototypes = [];

    public function initialize(): IteratorInterface
    {
        $this->processPrototypes = &$this->_getProcessCollection()->getProcessPrototypes();

        return $this;
    }

    function rewind()
    {
        return reset($this->processPrototypes);
    }

    function current(): ProcessInterface
    {
        return clone current($this->processPrototypes);
    }

    function key(): int
    {
        return key($this->processPrototypes);
    }

    function next()
    {
        return next($this->processPrototypes);
    }

    function valid(): bool
    {
        return key($this->processPrototypes) !== null;
    }
}