<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Kojo\PDO;

class Decorator implements DecoratorInterface
{
    use Doctrine\DBAL\Connection\AwareTrait;
    use PDO\Builder\Factory\AwareTrait;
    protected $pdo;
    protected $id;

    public function getDoctrineConnection(): Connection
    {
        if (!$this->hasDoctrineDBALConnection()) {
            if ($this->hasPDO()) {
                $serverVersion = $this->getPDO()->getAttribute(\PDO::ATTR_SERVER_VERSION);
                $connectionParameters = ['pdo' => $this->getPDO(), 'serverVersion' => $serverVersion];
            } else {
                $pdoBuilder = $this->getPDOBuilderFactory()->create();
                $serverVersion = $pdoBuilder->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION);
                $connectionParameters = ['pdo' => $pdoBuilder->getPdo(), 'serverVersion' => $serverVersion];
            }

            $connection = DriverManager::getConnection($connectionParameters);
//            $connection->getConfiguration()->setSQLLogger(new EchoSQLLogger());
            $this->setDoctrineDBALConnection($connection);
        }

        return $this->DoctrineDBALConnection;
    }

    protected function hasPDO(): bool
    {
        return $this->pdo === null ? false : true;
    }

    public function setPDO(\PDO $pdo): DecoratorInterface
    {
        if ($this->pdo === null) {
            $this->pdo = $pdo;
        } else {
            throw new \LogicException('PDO is already set.');
        }

        return $this;
    }

    protected function getPDO(): \PDO
    {
        if ($this->pdo === null) {
            throw new \LogicException('PDO is not set.');
        }

        return $this->pdo;
    }

    public function setId(string $id): Decorator
    {
        if ($this->id === null) {
            $this->id = $id;
        } else {
            throw new \LogicException('ID is already set.');
        }

        return $this;
    }

    public function getId(): string
    {
        if ($this->id === null) {
            throw new \LogicException('ID is not set.');
        }

        return $this->id;
    }
}