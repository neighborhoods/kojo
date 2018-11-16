<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Schema;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray\FactoryInterface;

interface RepositoryInterface
{
    public function setDoctrineConnectionDecoratorArrayFactory(
        FactoryInterface $doctrineConnectionDecoratorArrayFactory
    );

    public function createById(string $id): RepositoryInterface;

    public function get(string $id): DecoratorInterface;

    public function getConnection(string $id): Connection;

    public function add(DecoratorInterface $decorator): RepositoryInterface;

    public function replace(DecoratorInterface $decorator): RepositoryInterface;

    public function remove(DecoratorInterface $decorator): RepositoryInterface;

    public function createQueryBuilder(string $id): QueryBuilder;

    public function createSchema(string $id): Schema;

    public function getSchemaManager(string $id): AbstractSchemaManager;
}
