<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Data\Job\TypeInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

class Version_4_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $connectionDecoratorRepository = $this->_getDoctrineConnectionDecoratorRepository();
        $createSchema = $connectionDecoratorRepository->createSchema(DecoratorInterface::ID_SCHEMA);
        $createTable = $createSchema->createTable(TypeInterface::TABLE_NAME);
        $createTable->addColumn(TypeInterface::FIELD_NAME_ID, Type::BIGINT,
            [
                'autoincrement' => true,
                'unsigned' => true,
            ]
        );
        $createTable->setPrimaryKey([TypeInterface::FIELD_NAME_ID]);
        $createTable->addColumn(TypeInterface::FIELD_NAME_TYPE_CODE, Type::STRING);
        $createTable->addColumn(TypeInterface::FIELD_NAME_NAME, Type::STRING);
        $createTable->addColumn(TypeInterface::FIELD_NAME_WORKER_URI, Type::STRING);
        $createTable->addColumn(TypeInterface::FIELD_NAME_WORKER_METHOD, Type::STRING);
        $createTable->addColumn(TypeInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL, Type::BOOLEAN);
        $createTable->addColumn(TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(TypeInterface::FIELD_NAME_CRON_EXPRESSION, Type::STRING, ['notnull' => false]);
        $createTable->addColumn(TypeInterface::FIELD_NAME_SCHEDULE_LIMIT, Type::INTEGER,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addColumn(TypeInterface::FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE, Type::INTEGER,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addColumn(TypeInterface::FIELD_NAME_IS_ENABLED, Type::BOOLEAN);
        $createTable->addColumn(TypeInterface::FIELD_NAME_AUTO_COMPLETE_SUCCESS, Type::BOOLEAN);
        $createTable->addColumn(TypeInterface::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION, Type::DATEINTERVAL);
        $createTable->addUniqueIndex([TypeInterface::FIELD_NAME_TYPE_CODE]);
        $createTable->addIndex(
            [
                TypeInterface::FIELD_NAME_IS_ENABLED,
                TypeInterface::FIELD_NAME_CRON_EXPRESSION,
                TypeInterface::FIELD_NAME_TYPE_CODE,
                TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE,
                TypeInterface::FIELD_NAME_SCHEDULE_LIMIT,
                TypeInterface::FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE,
            ],
            TypeInterface::INDEX_NAME_SCHEDULER_COVERING
        );
        $createTable->addIndex([
            TypeInterface::FIELD_NAME_IS_ENABLED,
            TypeInterface::FIELD_NAME_TYPE_CODE,
        ],
            TypeInterface::INDEX_NAME_IS_ENABLED__CODE
        );
        $this->_setCreateTable($createTable);

        return $this;
    }
}