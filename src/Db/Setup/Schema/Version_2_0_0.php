<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Data\StatusInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Data\Status\TypeInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

class Version_2_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $connectionDecoratorRepository = $this->_getDoctrineConnectionDecoratorRepository();
        $createSchema = $connectionDecoratorRepository->createSchema(DecoratorInterface::ID_SCHEMA);
        $createTable = $createSchema->createTable(StatusInterface::TABLE_NAME);
        $createTable->addColumn(StatusInterface::FIELD_NAME_ID, Type::BIGINT,
            [
                'autoincrement' => true,
                'unsigned' => true,
            ]
        );
        $createTable->setPrimaryKey([StatusInterface::FIELD_NAME_ID]);
        $createTable->addColumn(StatusInterface::FIELD_NAME_STARTED_AT_DATE_TIME, Type::DATETIME);
        $createTable->addColumn(StatusInterface::FIELD_NAME_STARTED_AT_MICRO_TIME, Type::BIGINT, ['unsigned' => true]);
        $createTable->addColumn(StatusInterface::FIELD_NAME_FINALIZED_AT_DATE_TIME, Type::DATETIME,
            ['notnull' => false]
        );
        $createTable->addColumn(StatusInterface::FIELD_NAME_FINALIZED_AT_MICRO_TIME, Type::BIGINT,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addColumn(StatusInterface::FIELD_NAME_TYPE_CODE, Type::STRING);
        $createTable->addColumn(StatusInterface::FIELD_NAME_STATE, Type::STRING);
        $createTable->addColumn(StatusInterface::FIELD_NAME_MESSAGE_COUNT, Type::INTEGER, ['unsigned' => true]);
        $createTable->addColumn(StatusInterface::FIELD_NAME_ERROR_COUNT, Type::INTEGER,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addColumn(StatusInterface::FIELD_NAME_MAX_ERROR_LEVEL, Type::INTEGER,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addIndex([StatusInterface::FIELD_NAME_TYPE_CODE]);
        $createTable->addForeignKeyConstraint(
            TypeInterface::TABLE_NAME,
            [StatusInterface::FIELD_NAME_TYPE_CODE],
            [TypeInterface::FIELD_NAME_CODE],
            [
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE',
            ]
        );
        $this->_setCreateTable($createTable);

        return $this;
    }
}