<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Data\Status\TypeInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

class Version_1_0_0 extends VersionAbstract
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
        $createTable->addColumn(TypeInterface::FIELD_NAME_CODE, Type::STRING);
        $createTable->addColumn(TypeInterface::FIELD_NAME_NAME, Type::STRING);
        $createTable->addUniqueIndex([TypeInterface::FIELD_NAME_CODE], TypeInterface::FIELD_NAME_CODE);
        $this->_setCreateTable($createTable);

        return $this;
    }
}