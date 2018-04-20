<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection;

use Neighborhoods\Kojo\Db\PDO;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Db\Adapter\Driver\Pdo\Connection;
use Zend\Db\Adapter\Driver\StatementInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Driver;
use Zend\Db\Sql\Update;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Container implements ContainerInterface
{
    use Defensive\AwareTrait;
    use PDO\Builder\AwareTrait;
    protected $_connection;
    protected $_id;
    protected $_sql;
    protected $_adapter;
    protected $_pdo;
    protected $_driver;
    protected $_defaultPdo;

    public function setPdo(\PDO $pdo): ContainerInterface
    {
        if ($this->_pdo === null) {
            $this->_pdo = $pdo;
        }else {
            throw new \LogicException('PDO is already set.');
        }

        return $this;
    }

    protected function _getPdo(): \PDO
    {
        if ($this->_pdo === null) {
            $this->_pdo = $this->_getDbPDOBuilder()->getPdo();
        }

        return $this->_pdo;
    }

    public function getConnection(): Connection
    {
        if ($this->_connection === null) {
            $this->_connection = new Connection($this->_getPdo());
        }

        return $this->_connection;
    }

    public function setId(string $id): ContainerInterface
    {
        if ($this->_id === null) {
            $this->_id = $id;
        }else {
            throw new \LogicException('ID is already set.');
        }

        return $this;
    }

    public function getId(): string
    {
        if ($this->_id === null) {
            throw new \LogicException('ID is not set.');
        }

        return $this->_id;
    }

    public function getSql(): Sql
    {
        if ($this->_sql === null) {
            $this->_sql = new Sql($this->getAdapter());
        }

        return $this->_sql;
    }

    public function getAdapter(): Adapter
    {
        if ($this->_adapter === null) {
            $this->_adapter = new Adapter($this->getDriver());
        }

        return $this->_adapter;
    }

    public function getDriver(): DriverInterface
    {
        if ($this->_driver === null) {
            $this->_driver = new Driver\Pdo\Pdo($this->getConnection());
        }

        return $this->_driver;
    }

    public function getStatement(PreparableSqlInterface $preparableSql): StatementInterface
    {
        return $this->getSql()->prepareStatementForSqlObject($preparableSql);
    }

    public function select($table = null): Select
    {
        return $this->getSql()->select($table);
    }

    public function update($table = null): Update
    {
        return $this->getSql()->update($table);
    }

    public function insert($table = null): Insert
    {
        return $this->getSql()->insert($table);
    }

    public function delete($table = null): Delete
    {
        return $this->getSql()->delete($table);
    }

    public function beginTransaction(): Connection
    {
        return $this->getConnection()->beginTransaction();
    }

    public function commit(): Connection
    {
        return $this->getConnection()->commit();
    }

    public function rollback(): Connection
    {
        return $this->getConnection()->rollback();
    }
}