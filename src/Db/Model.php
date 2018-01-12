<?php

namespace NHDS\Jobs\Db;

use NHDS\Toolkit\Data\Property;
use NHDS\Jobs\Db;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use Zend\Db\Sql\Select;

class Model implements ModelInterface
{
    use Property\Persistent\AwareTrait;
    use Db\Connection\Container\AwareTrait;
    protected $_idPropertyName;
    protected $_tableName;

    public function setTableName(string $tableName): ModelInterface
    {
        if ($this->_tableName === null) {
            $this->_tableName = $tableName;
        }else {
            throw new \LogicException('Table name is already set.');
        }

        return $this;
    }

    public function getTableName(): string
    {
        if ($this->_tableName === null) {
            throw new \LogicException('Table name is not set.');
        }

        return $this->_tableName;
    }

    public function getIdPropertyName(): string
    {
        if ($this->_idPropertyName === null) {
            throw new \LogicException('ID property name is not set.');
        }

        return $this->_idPropertyName;
    }

    public function setIdPropertyName(string $idPropertyName): ModelInterface
    {
        if ($this->_idPropertyName === null) {
            $this->_idPropertyName = $idPropertyName;
        }else {
            throw new \LogicException('ID property name is already set.');
        }

        return $this;
    }

    public function setId(string $id): ModelInterface
    {
        $this->_setPersistentProperty($this->getIdPropertyName(), $id);

        return $this;
    }

    public function load(string $propertyName = null, $propertyValue = null): ModelInterface
    {
        if ($propertyName === null) {
            $propertyName = $this->getIdPropertyName();
        }
        if ($propertyValue === null) {
            $propertyValue = $this->_getPersistentProperty($propertyName);
        }

        $select = $this->_getLoadSelect($propertyName, $propertyValue);
        $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($select);
        $data = $statement->execute()->current();

        if ($data) {
            $this->_hydrate($data);
        }else {
            throw new \UnexpectedValueException('No data was loaded.');
        }

        return $this;
    }

    public function getId(): string
    {
        return $this->_getPersistentProperty($this->getIdPropertyName());
    }

    public function hasId(): bool
    {
        return $this->_hasPersistentProperty($this->getIdPropertyName());
    }

    protected function _getLoadSelect($field, $value): Select
    {
        $select = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->select($this->getTableName());
        $select->where([$field => $value]);

        return $select;
    }

    public function save(): ModelInterface
    {
        $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->beginTransaction();

        try{
            if ($this->hasId()) {
                $this->update();
            }else {
                $this->insert();
            }
            $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->commit();
        }catch(\Exception $exception){
            $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->rollBack();
            throw $exception;
        }

        return $this;
    }

    public function delete(): ModelInterface
    {
        $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->beginTransaction();
        try{
            $delete = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->delete($this->getTableName());
            $delete->where([$this->getIdPropertyName() => $this->getId()]);
            $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($delete);
            $statement->execute();
            $this->_unsetPersistentProperties();
            $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->commit();
        }catch(\Exception $e){
            $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->rollBack();
            throw $e;
        }

        return $this;
    }

    protected function insert(): ModelInterface
    {
        $insert = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->insert($this->getTableName());
        $insert->values($this->_getChangedPersistentProperties());
        $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($insert);
        $statement->execute();
        $id = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getDriver()->getLastGeneratedValue();
        $this->setId($id);
        $this->_unsetChangedPersistentProperties();

        return $this;
    }

    protected function update(): ModelInterface
    {
        $changedPersistentProperties = $this->_getChangedPersistentProperties();
        $update = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->update($this->getTableName());
        $update->where([$this->getIdPropertyName() => $this->getId()]);
        $update->set($changedPersistentProperties);
        $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($update);
        $statement->execute();
        $this->_unsetChangedPersistentProperties();

        return $this;
    }
}