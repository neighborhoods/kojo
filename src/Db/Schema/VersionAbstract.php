<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema;

use Doctrine\DBAL\Schema\Table;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Kojo\Db;
use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorInterface;

abstract class VersionAbstract implements VersionInterface
{
    use Db\Schema\Version\Map\AwareTrait;
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    protected $createTable;
    protected $tableName;

    public function applySchemaSetupChanges(): VersionInterface
    {
        $connection = $this->getDoctrineDBALConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_SCHEMA);
        if (!$connection->getSchemaManager()->tablesExist([$this->_getTableName()])) {
            $connection->beginTransaction();
            try {
                $this->assembleSchemaChanges();
                $connection->getSchemaManager()->createTable($this->_getCreateTable());
                $connection->commit();
            } catch (\Throwable $throwable) {
                $connection->rollBack();
                throw $throwable;
            }
        }

        return $this;
    }

    abstract protected function assembleSchemaChanges(): VersionInterface;

    public function applySchemaTearDownChanges(): VersionInterface
    {
        $this->assembleSchemaChanges();
        $connection = $this->getDoctrineDBALConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_SCHEMA);
        if ($connection->getSchemaManager()->tablesExist([$this->_getTableName()])) {
            $connection->beginTransaction();
            try {
                $connection->getSchemaManager()->dropTable($this->_getTableName());
                $connection->commit();
            } catch (\Throwable $throwable) {
                $connection->rollBack();
                throw $throwable;
            }
        }

        return $this;
    }

    public function setTableName(string $tableName): VersionInterface
    {
        if (!$this->hasTableName()) {
            $this->tableName = $tableName;
        } else {
            throw new \LogicException('DropTable name is already set.');
        }

        return $this;
    }

    protected function _getTableName(): string
    {
        if (!$this->hasTableName()) {
            throw new \LogicException('DropTable name is not set.');
        }

        return $this->tableName;
    }

    protected function hasTableName(): bool
    {
        return $this->tableName === null ? false : true;
    }

    protected function _setCreateTable(Table $createTable): VersionInterface
    {
        if (!$this->hasCreateTable()) {
            $this->createTable = $createTable;
        } else {
            throw new \LogicException('CreateTable is already set.');
        }

        return $this;
    }

    protected function _getCreateTable(): Table
    {
        if (!$this->hasCreateTable()) {
            throw new \LogicException('CreateTable is not set.');
        }

        return $this->createTable;
    }

    protected function hasCreateTable(): bool
    {
        return $this->createTable === null ? false : true;
    }
}