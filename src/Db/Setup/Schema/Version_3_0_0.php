<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Kojo\StateTransitionChangeInterface;
use Neighborhoods\Kojo\StateTransitionChange;

class Version_3_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $connectionDecoratorRepository = $this->_getDoctrineConnectionDecoratorRepository();
        $createSchema = $connectionDecoratorRepository->createSchema(DecoratorInterface::ID_SCHEMA);
        $createTable = $createSchema->createTable(StateTransitionChange\RepositoryInterface::TABLE_NAME);
        $createTable->addColumn(StateTransitionChangeInterface::PROP_ID, Type::BIGINT,
            [
                'autoincrement' => true,
                'unsigned' => true
            ]
        );
        $createTable->setPrimaryKey([StateTransitionChangeInterface::PROP_ID]);
        $createTable->addColumn(StateTransitionChangeInterface::PROP_DATA, Type::TEXT);
        $this->_setCreateTable($createTable);

        return $this;
    }
}
