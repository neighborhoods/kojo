<?php

namespace NHDS\Toolkit\Data\Property\Strict;

trait AwareTrait
{
    protected $_strictProperties = [];

    protected function _create(string $propertyName, $propertyValue)
    {
        if ($this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is already created.');
        }
        $this->_strictProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function &_read(string $propertyName)
    {
        if (!$this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is not created.');
        }

        return $this->_strictProperties[$propertyName];
    }

    protected function _update(string $propertyName, $propertyValue)
    {
        if (!$this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is not created.');
        }
        $this->_strictProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function _createOrUpdate(string $propertyName, $propertyValue)
    {
        $this->_strictProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function _delete(string $propertyName)
    {
        if (!$this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is not created.');
        }
        unset($this->_strictProperties[$propertyName]);

        return $this;
    }

    protected function _exists(string $propertyName): bool
    {
        return isset($this->_strictProperties[$propertyName]) ? true : false;
    }
}