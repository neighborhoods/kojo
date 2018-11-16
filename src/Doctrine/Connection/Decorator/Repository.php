<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Schema;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArrayInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Pylon\Data;

class Repository implements RepositoryInterface
{
    use Doctrine\Connection\DecoratorArray\Factory\AwareTrait;
    use Doctrine\Connection\Decorator\Factory\AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    protected $_doctrineConnectionDecoratorArray;

    public function createById(string $id): RepositoryInterface
    {
        if (isset($this->_getDoctrineConnectionDecoratorArray()[$id])) {
            throw new \LogicException("Decorator with ID[$id] already exists.");
        } else {
            $connectionDecorator = $this->_getDoctrineConnectionDecoratorFactory()->create()->setId($id);
            $this->_getDoctrineConnectionDecoratorArray()[$id] = $connectionDecorator;
        }

        return $this;
    }

    public function get(string $id): DecoratorInterface
    {
        if (!isset($this->_getDoctrineConnectionDecoratorArray()[$id])) {
            throw new \LogicException("Decorator with ID[$id] is not set.");
        }

        return $this->_getDoctrineConnectionDecoratorArray()[$id];
    }

    public function remove(DecoratorInterface $decorator): RepositoryInterface
    {
        $id = $decorator->getId();
        if (isset($this->_getDoctrineConnectionDecoratorArray()[$id])) {
            unset($this->_getDoctrineConnectionDecoratorArray()[$id]);
        } else {
            throw new \LogicException("Decorator with ID[$id] does not exist.");
        }

        return $this;
    }

    public function add(DecoratorInterface $decorator): RepositoryInterface
    {
        $id = $decorator->getId();
        if (isset($this->_getDoctrineConnectionDecoratorArray()[$id])) {
            throw new \LogicException("Decorator with ID[$id] already exists.");
        }
        $this->_getDoctrineConnectionDecoratorArray()[$id] = $decorator;

        return $this;
    }

    public function replace(DecoratorInterface $decorator): RepositoryInterface
    {
        $id = $decorator->getId();
        if (!isset($this->_getDoctrineConnectionDecoratorArray()[$id])) {
            throw new \LogicException("Decorator with ID[$id] does not exist.");
        }
        unset($this->_getDoctrineConnectionDecoratorArray()[$id]);
        $this->_getDoctrineConnectionDecoratorArray()[$id] = $decorator;

        return $this;
    }

    public function getConnection(string $id): Connection
    {
        return $this->get($id)->getDoctrineConnection();
    }

    public function createQueryBuilder(string $id): QueryBuilder
    {
        return $this->getConnection($id)->createQueryBuilder();
    }

    public function getSchemaManager(string $id): AbstractSchemaManager
    {
        return $this->getConnection($id)->getSchemaManager();
    }
    public function createSchema(string $id): Schema
    {
        return $this->getSchemaManager($id)->createSchema();
    }

    protected function _getDoctrineConnectionDecoratorArray(): DecoratorArrayInterface
    {
        if ($this->_doctrineConnectionDecoratorArray === null) {
            $this->_doctrineConnectionDecoratorArray = $this->_getDoctrineConnectionDecoratorArrayFactory()->create();
        }

        return $this->_doctrineConnectionDecoratorArray;
    }
}
