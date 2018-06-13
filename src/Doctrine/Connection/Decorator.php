<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Pylon\Data;
use Neighborhoods\Kojo\PDO;

class Decorator implements DecoratorInterface
{
    use Data\Property\Defensive\AwareTrait;
    use PDO\Builder\Factory\AwareTrait;
    protected const PROP_ID = 'id';
    protected $_pdo;

    public function getDoctrineConnection(): Connection
    {
        if (!$this->_exists(Connection::class)) {
            if ($this->_hasPDO()) {
                $serverVersion = $this->_getPDO()->getAttribute(\PDO::ATTR_SERVER_VERSION);
                $connection = DriverManager::getConnection(['pdo' => $this->_getPDO(), 'serverVersion' => $serverVersion]);
            } else {
                $pdoBuilder = $this->_getPDOBuilderFactory()->create();
                $serverVersion = $pdoBuilder->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION);
                $connection = DriverManager::getConnection(['pdo' => $pdoBuilder->getPdo(), 'serverVersion' => $serverVersion]);
            }

//            $connection->getConfiguration()->setSQLLogger(new EchoSQLLogger());
            $this->_create(Connection::class, $connection);
        }

        return $this->_read(Connection::class);
    }

    protected function _hasPDO(): bool
    {
        return $this->_pdo === null ? false : true;
    }

    public function setPDO(\PDO $pdo): DecoratorInterface
    {
        if ($this->_pdo === null) {
            $this->_pdo = $pdo;
        } else {
            throw new \LogicException('PDO is already set.');
        }

        return $this;
    }

    protected function _getPDO(): \PDO
    {
        if ($this->_pdo === null) {
            throw new \LogicException('PDO is not set.');
        }

        return $this->_pdo;
    }

    public function setId(string $id): Decorator
    {
        return $this->_create(self::PROP_ID, $id);
    }

    public function getId(): string
    {
        return $this->_read(self::PROP_ID);
    }
}
