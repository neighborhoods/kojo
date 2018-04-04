<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information;

use Neighborhoods\Kojo\Process\Signal\InformationInterface;

class Collection implements CollectionInterface
{
    protected $_position              = 0;
    protected $_informationCollection = [];

    public function addInformation(InformationInterface $information): CollectionInterface
    {
        $this->_informationCollection[] = $information;

        return $this;
    }

    public function unsetInformation(int $position): CollectionInterface
    {
        if (!isset($this->_informationCollection[$position])) {
            throw new \LogicException("Information at position[$position] is not set.");
        }
        unset($this->_informationCollection[$position]);

        return $this;
    }

    public function current(): InformationInterface
    {
        return $this->_informationCollection[$this->_position];
    }

    public function next()
    {
        return ++$this->_position;
    }

    public function key(): int
    {
        return $this->_position;
    }

    public function valid(): bool
    {
        return isset($this->_informationCollection[$this->_position]);
    }

    public function rewind()
    {
        $position = reset($this->_informationCollection);
        if ($position !== false) {
            $this->_position = key($this->_informationCollection);
        }else {
            $this->_position = 0;
        }

        return;
    }
}