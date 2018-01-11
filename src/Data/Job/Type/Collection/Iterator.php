<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Db\Model\Collection;

class Iterator implements IteratorInterface
{
    use Strict\AwareTrait;
    use Collection\AwareTrait;

    function rewind()
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return reset($modelsArray);
    }

    function current(): TypeInterface
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return current($modelsArray);
    }

    function key(): int
    {
        $modelsArray = &$this->_getCollection()->getModelsArray();

        return key($modelsArray);
    }

    function next()
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