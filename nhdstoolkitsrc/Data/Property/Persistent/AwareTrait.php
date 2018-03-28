<?php
declare(strict_types=1);

namespace Neighborhoods\Toolkit\Data\Property\Persistent;

trait AwareTrait
{
    protected $_persistentProperties        = [];
    protected $_changedPersistentProperties = [];

    public function createPersistentProperties(array $persistentProperties)
    {
        if (!$this->_hasPersistentProperties()) {
            $this->_persistentProperties = $persistentProperties;
            $this->_changedPersistentProperties = $persistentProperties;
        }else {
            throw new \LogicException('Persistent properties is already set.');
        }

        return $this;
    }

    protected function _emptyPersistentProperties()
    {
        if ($this->_hasPersistentProperties()) {
            $this->_persistentProperties = [];
            $this->_changedPersistentProperties = [];
        }else {
            throw new \LogicException('Persistent properties is not set.');
        }

        return $this;
    }

    protected function _hydrate(array $persistentProperties)
    {
        $this->_persistentProperties = array_replace($this->_persistentProperties, $persistentProperties);
        $this->_changedPersistentProperties = [];

        return $this;
    }

    protected function _createPersistentProperty(string $persistentPropertyName, $persistentPropertyValue)
    {
        if ($this->_hasPersistentProperty($persistentPropertyName)) {
            throw new \LogicException('Persistent property ' . $persistentPropertyName . ' is already set.');
        }else {
            $this->_persistentProperties[$persistentPropertyName] = $persistentPropertyValue;
            $this->_changedPersistentProperties[$persistentPropertyName] = $persistentPropertyValue;
        }

        return $this;
    }

    protected function _readPersistentProperty(string $persistentPropertyName)
    {
        if (!isset($this->_persistentProperties[$persistentPropertyName])) {
            throw new \LogicException('Persistent property ' . $persistentPropertyName . ' is not set');
        }

        return $this->_persistentProperties[$persistentPropertyName];
    }

    protected function _unsetPersistentProperty(string $persistentPropertyName)
    {
        if ($this->_hasPersistentProperty($persistentPropertyName)) {
            unset($this->_persistentProperties[$persistentPropertyName]);
            $this->_changedPersistentProperties[$persistentPropertyName] = null;
        }else {
            throw new \LogicException('Persistent property is not set.');
        }

        return $this;
    }

    public function readPersistentProperties(): array
    {
        if (!$this->_hasPersistentProperties()) {
            throw new \LogicException('Persistent properties is not set.');
        }

        return $this->_persistentProperties;
    }

    protected function _createOrUpdatePersistentProperty(string $persistentPropertyName, $persistentPropertyValue)
    {
        $this->_persistentProperties[$persistentPropertyName] = $persistentPropertyValue;
        $this->_changedPersistentProperties[$persistentPropertyName] = $persistentPropertyValue;

        return $this;
    }

    protected function _hasPersistentProperty(string $persistentPropertyName): bool
    {
        return isset($this->_persistentProperties[$persistentPropertyName]);
    }

    protected function _hasPersistentProperties(): bool
    {
        return empty($this->_persistentProperties) ? false : true;
    }

    public function hasChangedPersistentProperties(): bool
    {
        return empty($this->_changedPersistentProperties) ? false : true;
    }

    protected function _readChangedPersistentProperties(): array
    {
        if (!$this->hasChangedPersistentProperties()) {
            throw new \LogicException('Changed persistent properties is not set.');
        }

        return $this->_changedPersistentProperties;
    }

    protected function _emptyChangedPersistentProperties()
    {
        if ($this->hasChangedPersistentProperties()) {
            $this->_changedPersistentProperties = [];
        }else {
            throw new \LogicException('Changed persistent properties is not set.');
        }

        return $this;
    }
}