<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Db\Adapter\Driver\Pdo\Connection;
use Zend\Db\Adapter\Driver\StatementInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;

interface ContainerInterface
{
    const NAME_SCHEMA            = 'schema';
    const NAME_TEAR_DOWN         = 'tear_down';
    const NAME_JOB               = 'job';
    const NAME_STATUS            = 'status';
    const NAME_NON_TRANSACTIONAL = 'non_transactional';

    public function getConnection(): Connection;

    public function setName(string $name): ContainerInterface;

    public function getName(): string;

    public function getSql(): Sql;

    public function getAdapter(): Adapter;

    public function getDriver(): DriverInterface;

    public function getStatement(PreparableSqlInterface $preparableSql): StatementInterface;

    public function select($table = null): Select;

    public function update($table = null): Update;

    public function insert($table = null): Insert;

    public function delete($table = null): Delete;

    public function beginTransaction(): Connection;

    public function commit(): Connection;

    public function rollback(): Connection;

    public function setPdo(\PDO $pdo): ContainerInterface;
}