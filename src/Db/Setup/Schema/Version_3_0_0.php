<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Data\Status\MessageInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

class Version_3_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $connectionDecoratorRepository = $this->_getDoctrineConnectionDecoratorRepository();
        $createSchema = $connectionDecoratorRepository->createSchema(DecoratorInterface::ID_SCHEMA);
        $createTable = $createSchema->createTable(MessageInterface::TABLE_NAME);
        $createTable->addColumn(MessageInterface::FIELD_NAME_ID, Type::BIGINT,
            [
                'autoincrement' => true,
                'unsigned' => true,
            ]
        );
        $createTable->setPrimaryKey([MessageInterface::FIELD_NAME_ID]);
        $createTable->addColumn(MessageInterface::FIELD_NAME_STATUS_ID, Type::BIGINT, ['unsigned' => true]);
        $createTable->addColumn(MessageInterface::FIELD_NAME_DATE_TIME, Type::DATETIME);
        $createTable->addColumn(MessageInterface::FIELD_NAME_MICRO_TIME, Type::BIGINT, ['unsigned' => true]);
        $createTable->addColumn(MessageInterface::FIELD_NAME_LEVEL, Type::INTEGER,
            [
                'unsigned' => true,
                'notnull' => false,
            ]
        );
        $createTable->addColumn(MessageInterface::FIELD_NAME_MESSAGE, Type::TEXT);
        $createTable->addIndex([MessageInterface::FIELD_NAME_STATUS_ID]);
        $this->_setCreateTable($createTable);

        return $this;
    }
}