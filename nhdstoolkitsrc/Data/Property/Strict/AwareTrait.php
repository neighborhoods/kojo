<?php

namespace NHDS\Toolkit\Data\Property\Strict;

trait AwareTrait
{
    protected $_crudProperties = [];

    protected function _create(string $propertyName, $propertyValue)
    {
        if ($this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is already created.');
        }
        $this->_crudProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function &_read(string $propertyName)
    {
        if (!$this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is not created.');
        }

        return $this->_crudProperties[$propertyName];
    }

    protected function _update(string $propertyName, $propertyValue)
    {
        if (!$this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is not created.');
        }
        $this->_crudProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function _updateOrInsert(string $propertyName, $propertyValue)
    {
        $this->_crudProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function _delete(string $propertyName)
    {
        if (!$this->_exists($propertyName)) {
            throw new \LogicException($propertyName . ' is not created.');
        }
        unset($this->_crudProperties[$propertyName]);

        return $this;
    }

    protected function _exists(string $propertyName): bool
    {
        return isset($this->_crudProperties[$propertyName]) ? true : false;
    }
}