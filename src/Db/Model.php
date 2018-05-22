<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Kojo\Exception\Runtime\Db\Model\LoadException;
use Neighborhoods\Pylon\Data\Property;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Model implements ModelInterface
{
    use Defensive\AwareTrait;
    use Property\Persistent\AwareTrait;
    use Doctrine\Connection\Decorator\Repository\AwareTrait;
    protected $_idPropertyName;
    protected $_tableName;

    public function setTableName(string $tableName): ModelInterface
    {
        if ($this->_tableName === null) {
            $this->_tableName = $tableName;
        } else {
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
        } else {
            throw new \LogicException('ID property name is already set.');
        }

        return $this;
    }

    public function setId(int $id): ModelInterface
    {
        $this->_createPersistentProperty($this->getIdPropertyName(), $id);

        return $this;
    }

    public function load(string $propertyName = null, $propertyValue = null): ModelInterface
    {
        if ($propertyName === null) {
            $propertyName = $this->getIdPropertyName();
        }
        if ($propertyValue === null) {
            $propertyValue = $this->_readPersistentProperty($propertyName);
        }

        $loadQueryBuilder = $this->_getLoadQueryBuilder($propertyName, $propertyValue);
        $record = $loadQueryBuilder->execute()->fetchAll();

        if (isset($record[0])) {
            if (!isset($record[1])) {
                $this->_hydrate($record[0]);
            } else {
                throw (new LoadException())->setCode(LoadException::CODE_MULTIPLE_RECORDS_RETRIEVED);
            }
        } else {
            throw (new LoadException())->setCode(LoadException::CODE_NO_DATA_LOADED);
        }

        return $this;
    }

    public function getId(): int
    {
        return (int)$this->_readPersistentProperty($this->getIdPropertyName());
    }

    public function hasId(): bool
    {
        return $this->_hasPersistentProperty($this->getIdPropertyName());
    }

    protected function _getLoadQueryBuilder($field, $value): QueryBuilder
    {
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_JOB);
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder = $queryBuilder->select('*')->from($this->getTableName());
        $queryBuilder->where($queryBuilder->expr()->eq($field, $queryBuilder->createNamedParameter($value)));

        return $queryBuilder;
    }

    public function save(): ModelInterface
    {
        if ($this->hasId()) {
            $this->update();
        } else {
            $this->insert();
        }

        return $this;
    }

    public function delete(): ModelInterface
    {
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_JOB);
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->delete($this->getTableName());
        $queryBuilder->where(
            $queryBuilder->expr()->eq($this->getIdPropertyName(), $this->getId())
        );
        $queryBuilder->execute();
        $this->_emptyPersistentProperties();

        return $this;
    }

    protected function insert(): ModelInterface
    {
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_JOB);
        $changedPersistentProperties = $this->_readChangedPersistentProperties();
        $changedPersistentPropertyTypes = [];
        foreach ($changedPersistentProperties as $changedPersistentProperty) {
            switch ($type = gettype($changedPersistentProperty)) {
                case 'boolean':
                    $changedPersistentPropertyTypes[] = \PDO::PARAM_BOOL;
                    break;
                case 'integer':
                case 'double':
                case 'float':
                    $changedPersistentPropertyTypes[] = \PDO::PARAM_INT;
                    break;
                case 'string':
                    $changedPersistentPropertyTypes[] = \PDO::PARAM_STR;
                    break;
                default:
                    throw new \UnexpectedValueException("Type[$type] is unexpected.");
            }
        }
        $connection->insert(
            $this->getTableName(),
            $this->_readChangedPersistentProperties(),
            $changedPersistentPropertyTypes
        );
        $id = (int)$connection->lastInsertId();
        $this->setId($id);
        $this->_emptyChangedPersistentProperties();

        return $this;
    }

    protected function update(): ModelInterface
    {
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_JOB);
        $changedPersistentProperties = $this->_readChangedPersistentProperties();
        $changedPersistentPropertyTypes = [];
        foreach ($changedPersistentProperties as $changedPersistentProperty) {
            switch ($type = gettype($changedPersistentProperty)) {
                case 'boolean':
                    $changedPersistentPropertyTypes[] = \PDO::PARAM_BOOL;
                    break;
                case 'integer':
                case 'double':
                case 'float':
                    $changedPersistentPropertyTypes[] = \PDO::PARAM_INT;
                    break;
                case 'string':
                    $changedPersistentPropertyTypes[] = \PDO::PARAM_STR;
                    break;
                default:
                    throw new \UnexpectedValueException("Type[$type] is unexpected.");
            }
        }
        $connection->update(
            $this->getTableName(),
            $changedPersistentProperties,
            [$this->getIdPropertyName() => $this->getId()],
            $changedPersistentPropertyTypes
        );
        $this->_emptyChangedPersistentProperties();

        return $this;
    }
}