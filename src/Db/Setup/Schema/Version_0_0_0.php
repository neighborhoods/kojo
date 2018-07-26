<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Doctrine\DBAL\Types\Type;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorInterface;

class Version_0_0_0 extends VersionAbstract
{
    protected function assembleSchemaChanges(): VersionInterface
    {
        $connectionDecoratorRepository = $this->getDoctrineDBALConnectionDecoratorRepository();
        $createSchema = $connectionDecoratorRepository->createSchema(DecoratorInterface::ID_SCHEMA);
        $createTable = $createSchema->createTable($this->_getTableName());
        $createTable->addColumn('version', Type::STRING,
            [
                'notnull' => false,
            ]
        );
        $this->_setCreateTable($createTable);

        return $this;
    }
}