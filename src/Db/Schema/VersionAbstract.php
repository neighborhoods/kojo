<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema;

use Doctrine\DBAL\Schema\Table;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Doctrine\DBAL\Types\Type;

abstract class VersionAbstract implements VersionInterface
{
    use Defensive\AwareTrait;
    use Doctrine\Connection\Decorator\Repository\AwareTrait;
    protected $_createTable;
    protected $_tableName;

    public function applySchemaSetupChanges(): VersionInterface
    {
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_SCHEMA);
        if (!$connection->getSchemaManager()->tablesExist([$this->_getTableName()])) {
            while (true) {
                $connection->beginTransaction();
                try {
                    $this->_assembleSchemaChanges();
                    $connection->getSchemaManager()->createTable($this->_getCreateTable());
                    $connection->commit();
                    break;
                } catch (\Doctrine\DBAL\DBALException $e) {
                    $stackTrace = $e->getTrace();
                    $exceptionThrowingFunctionTrace = $stackTrace[0];
                    $exceptionThrowingFunctionName = $exceptionThrowingFunctionTrace['function'];

                    if ($exceptionThrowingFunctionName === 'getDoctrineTypeMapping') {
                        $unsupportedType = $exceptionThrowingFunctionTrace['args'][0];

                        // roll back transaction so we don't have any inconsistent state
                        $connection->rollBack();

                        // tell Doctrine to treat this non-standard type (e.g. enum, point, geometry) as a string
                        // kojo doesn't use non-standard types, but Doctrine scans all tables when attempting
                        // to apply your schema changes
                        $connection->getDatabasePlatform()->registerDoctrineTypeMapping($unsupportedType, Type::STRING);

                        continue;
                    } else {
                        throw $e;
                    }
                } catch (\Throwable $throwable) {
                    $connection->rollBack();
                    throw $throwable;
                }
            }
        }

        return $this;
    }

    abstract protected function _assembleSchemaChanges(): VersionInterface;

    public function applySchemaTearDownChanges(): VersionInterface
    {
        $this->_assembleSchemaChanges();
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_SCHEMA);
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
        if (!$this->_hasTableName()) {
            $this->_tableName = $tableName;
        } else {
            throw new \LogicException('DropTable name is already set.');
        }

        return $this;
    }

    protected function _getTableName(): string
    {
        if (!$this->_hasTableName()) {
            throw new \LogicException('DropTable name is not set.');
        }

        return $this->_tableName;
    }

    protected function _hasTableName(): bool
    {
        return $this->_tableName === null ? false : true;
    }

    protected function _setCreateTable(Table $createTable): VersionInterface
    {
        if (!$this->_hasCreateTable()) {
            $this->_createTable = $createTable;
        } else {
            throw new \LogicException('CreateTable is already set.');
        }

        return $this;
    }

    protected function _getCreateTable(): Table
    {
        if (!$this->_hasCreateTable()) {
            throw new \LogicException('CreateTable is not set.');
        }

        return $this->_createTable;
    }

    protected function _hasCreateTable(): bool
    {
        return $this->_createTable === null ? false : true;
    }
}
