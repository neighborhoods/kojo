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
    protected $_mostRecentUnsupportedType;

    public function applySchemaSetupChanges(): VersionInterface
    {
        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_SCHEMA);
        if (!$connection->getSchemaManager()->tablesExist([$this->_getTableName()])) {
            try {
                $connection->beginTransaction();
                while (!$this->_canAssembleSchemaChanges()) {
                    $connection->rollBack();
                    $connection
                        ->getDatabasePlatform()
                        ->registerDoctrineTypeMapping(
                            $this->_getMostRecentUnsupportedType(),
                            Type::STRING
                        );
                    $connection->beginTransaction();
                }
                $connection->getSchemaManager()->createTable($this->_getCreateTable());
                $connection->commit();
            } catch (\Throwable $throwable) {
                $connection->rollBack();
                throw $throwable;
            }
        }
        return $this;
    }

    protected function _canAssembleSchemaChanges(): bool
    {
        try {
            $this->_assembleSchemaChanges();
        } catch (\Doctrine\DBAL\DBALException $e) {
            if ($this->_isUnsupportedTypeException($e)) {
                return false;
            }

            throw $e;
        }

        return true;
    }

    protected function _isUnsupportedTypeException(\Doctrine\DBAL\DBALException $e) : bool
    {
        $stackTrace = $e->getTrace();
        $exceptionThrowingFunctionTrace = $stackTrace[0];

        if ($exceptionThrowingFunctionTrace['function'] !== 'getDoctrineTypeMapping') {
            return false;
        }

        $this->_setMostRecentUnsupportedType($exceptionThrowingFunctionTrace['args'][0]);
        return true;
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

    protected function _getMostRecentUnsupportedType() : string
    {
        if ($this->_mostRecentUnsupportedType === null) {
            throw new \LogicException('MostRecentUnsupportedType is not set.');
        }
        return $this->_mostRecentUnsupportedType;
    }

    protected function _setMostRecentUnsupportedType(string $mostRecentUnsupportedType) : VersionInterface
    {
        $this->_mostRecentUnsupportedType = $mostRecentUnsupportedType;
        return $this;
    }
}
