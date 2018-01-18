<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Db\Model\Collection;

class Iterator implements IteratorInterface
{
    use Strict\AwareTrait;
    use Collection\AwareTrait;
    protected $_models = [];

    public function initialize(): IteratorInterface
    {
        $this->_models = &$this->_getCollection()->getModelsArray();

        return $this;
    }

    function rewind()
    {
        return reset($this->_models);
    }

    function current(): JobInterface
    {
        return current($this->_models);
    }

    function key(): int
    {
        return key($this->_models);
    }

    function next()
    {
        return next($this->_models);
    }

    function valid(): bool
    {
        return key($this->_models) !== null;
    }
}