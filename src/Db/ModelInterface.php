<?php

namespace NHDS\Jobs\Db;

use NHDS\Jobs\Db\Connection\ContainerInterface;

interface ModelInterface
{
    public function setTableName(string $tableName): ModelInterface;

    public function getTableName(): string;

    public function getIdPropertyName(): string;

    public function setIdPropertyName(string $idPropertyName): ModelInterface;

    public function setId(string $id): ModelInterface;

    public function load(string $propertyName = null, $propertyValue = null): ModelInterface;

    public function getId(): string;

    public function hasId(): bool;

    public function save(): ModelInterface;

    public function delete(): ModelInterface;

    public function createPersistentProperties(array $persistentProperties);

    public function readPersistentProperties(): array;

    public function addDbConnectionContainer(ContainerInterface $container);
}