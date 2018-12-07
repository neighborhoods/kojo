<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Data\Job\TypeInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

class Version_2_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $connectionDecoratorRepository = $this->_getDoctrineConnectionDecoratorRepository();
        $createSchema = $connectionDecoratorRepository->createSchema(DecoratorInterface::ID_SCHEMA);
        $createTable = $createSchema->createTable(JobInterface::TABLE_NAME);
        $createTable->addColumn(JobInterface::FIELD_NAME_ID, Type::BIGINT,
            [
                'autoincrement' => true,
                'unsigned' => true,
            ]
        );
        $createTable->setPrimaryKey([JobInterface::FIELD_NAME_ID]);
        $createTable->addColumn(JobInterface::FIELD_NAME_TYPE_CODE, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_NAME, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_PRIORITY, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_IMPORTANCE, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_WORK_AT_DATE_TIME, Type::DATETIME);
        $createTable->addColumn(JobInterface::FIELD_NAME_NEXT_STATE_REQUEST, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_ASSIGNED_STATE, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_PREVIOUS_STATE, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_WORKER_URI, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_WORKER_METHOD, Type::STRING);
        $createTable->addColumn(JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL, Type::BOOLEAN);
        $createTable->addColumn(JobInterface::FIELD_NAME_LAST_TRANSITION_DATE_TIME, Type::DATETIME,
            ['unsigned' => true]
        );
        $createTable->addColumn(JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME, Type::BIGINT,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addColumn(JobInterface::FIELD_NAME_TIMES_WORKED, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_TIMES_RETRIED, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_TIMES_HELD, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_TIMES_CRASHED, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_TIMES_PANICKED, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(JobInterface::FIELD_NAME_CREATED_AT_DATE_TIME, Type::DATETIME, ['notnull' => false]);
        $createTable->addColumn(JobInterface::FIELD_NAME_COMPLETED_AT_DATE_TIME, Type::DATETIME, ['notnull' => false]);
        $createTable->addColumn(JobInterface::FIELD_NAME_DELETE_AFTER_DATE_TIME, Type::DATETIME, ['notnull' => false]);
        $createTable->addColumn(JobInterface::FIELD_NAME_MOST_RECENT_HOST_NAME, Type::STRING, ['notnull' => false]);
        $createTable->addColumn(JobInterface::FIELD_NAME_MOST_RECENT_PROCESS_ID, Type::INTEGER,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addIndex([
            JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
            JobInterface::FIELD_NAME_ASSIGNED_STATE,
            JobInterface::FIELD_NAME_WORK_AT_DATE_TIME,
            JobInterface::FIELD_NAME_PRIORITY,

        ],
            JobInterface::INDEX_NAME_CRASHED_AND_SELECTION_AND_LIMIT_CHECK
        );
        $createTable->addIndex([
            JobInterface::FIELD_NAME_TYPE_CODE,
            JobInterface::FIELD_NAME_ASSIGNED_STATE,
            JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
            JobInterface::FIELD_NAME_PRIORITY,
            JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
        ],
            JobInterface::INDEX_NAME_PENDING
        );
        $createTable->addForeignKeyConstraint(
            TypeInterface::TABLE_NAME,
            [JobInterface::FIELD_NAME_TYPE_CODE],
            [TypeInterface::FIELD_NAME_TYPE_CODE],
            [
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE',
            ]
        );
        $this->_setCreateTable($createTable);

        return $this;
    }
}
