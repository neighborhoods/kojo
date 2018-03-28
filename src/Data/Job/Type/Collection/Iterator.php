<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Type\Collection;

use Neighborhoods\Kojo\Data\Job\TypeInterface;
use Neighborhoods\Toolkit\Data\Property\Strict;
use Neighborhoods\Kojo\Db\Model\Collection;

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