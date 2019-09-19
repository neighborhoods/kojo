<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection;

use Doctrine\DBAL\Connection;
use Neighborhoods\Kojo\PDO\Builder\FactoryInterface;

interface DecoratorInterface
{
    public const ID_TEAR_DOWN = 'tear_down';
    public const ID_SCHEMA = 'schema';
    public const ID_STATUS = 'status';
    public const ID_JOB = 'job';
    public const ID_NON_TRANSACTIONAL = 'non_transactional';
    public const ID_STATE_TRANSITION_CHANGE = 'state_transition_logger';

    public function getDoctrineConnection(): Connection;

    public function setPDOBuilderFactory(FactoryInterface $dbPDOBuilderFactory);

    public function setId(string $id): Decorator;

    public function getId(): string;

    public function setPDO(\PDO $pdo): DecoratorInterface;
}
