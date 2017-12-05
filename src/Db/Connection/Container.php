<?php

namespace NHDS\Jobs\Db\Connection;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Db\Adapter\Driver\Pdo\Connection;
use Zend\Db\Adapter\Driver\StatementInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use \Zend\Db\Adapter\Driver\Pdo\Pdo as PdoDriver;
use Zend\Db\Sql\Update;

class Container implements ContainerInterface
{
    protected $_connection;
    protected $_name;
    protected $_sql;
    protected $_adapter;
    protected $_pdo;
    protected $_driver;

    public function setPdo(\PDO $pdo): ContainerInterface
    {
        if ($this->_pdo === null) {
            $this->_pdo = $pdo;
        }else {
            throw new \LogicException('PDO is already set.');
        }

        return $this;
    }

    protected function _getPdo(): \Pdo
    {
        if ($this->_pdo === null) {
            throw new \LogicException('PDO is not set.');
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

    public function setName(string $name): ContainerInterface
    {
        if ($this->_name === null) {
            $this->_name = $name;
        }else {
            throw new \LogicException('Name is already set.');
        }

        return $this;
    }

    public function getName(): string
    {
        if ($this->_name === null) {
            throw new \LogicException('Name is not set.');
        }

        return $this->_name;
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
            $this->_driver = new PdoDriver($this->getConnection());
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