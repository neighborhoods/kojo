<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Property\Crud;
use NHDS\Jobs\Db\Model\Collection;

class Iterator implements IteratorInterface
{
    use Crud\AwareTrait;
    use Collection\AwareTrait;

    function rewind()
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return reset($modelsArray);
    }

    function current(): JobInterface
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return current($modelsArray);
    }

    function key(): int
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return key($modelsArray);
    }

    function next(): JobInterface
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return next($modelsArray);
    }

    function valid(): bool
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return key($modelsArray) !== null;
    }
}