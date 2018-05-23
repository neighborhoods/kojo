<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

interface ModelInterface
{
    public function setTableName(string $tableName) : ModelInterface;

    public function getTableName() : string;

    public function getIdPropertyName() : string;

    public function setIdPropertyName(string $idPropertyName) : ModelInterface;

    public function setId(int $id) : ModelInterface;

    public function load(string $propertyName = null, $propertyValue = null) : ModelInterface;

    public function getId() : int;

    public function hasId() : bool;

    public function save() : ModelInterface;

    public function delete() : ModelInterface;

    public function createPersistentProperties(array $persistentProperties);

    public function readPersistentProperties() : array;
}