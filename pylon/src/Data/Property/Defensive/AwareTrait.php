<?php
declare(strict_types=1);

namespace Neighborhoods\Pylon\Data\Property\Defensive;

trait AwareTrait
{
    protected $_defendedProperties = [];

    protected function _create(string $propertyName, $propertyValue)
    {
        assert(!$this->_exists($propertyName), new \LogicException($propertyName . ' is already created.'));
        $this->_defendedProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function &_read(string $propertyName)
    {
        assert($this->_exists($propertyName), new \LogicException($propertyName . ' is not created.'));

        return $this->_defendedProperties[$propertyName];
    }

    protected function _update(string $propertyName, $propertyValue)
    {
        assert($this->_exists($propertyName), new \LogicException($propertyName . ' is not created.'));
        $this->_defendedProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function _createOrUpdate(string $propertyName, $propertyValue)
    {
        $this->_defendedProperties[$propertyName] = $propertyValue;

        return $this;
    }

    protected function _delete(string $propertyName)
    {
        assert($this->_exists($propertyName), new \LogicException($propertyName . ' is not created.'));
        unset($this->_defendedProperties[$propertyName]);

        return $this;
    }

    protected function _exists(string $propertyName): bool
    {
        return isset($this->_defendedProperties[$propertyName]) ? true : false;
    }
}