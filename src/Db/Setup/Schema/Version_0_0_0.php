<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\CreateTable;

class Version_0_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable('kojo_jobs_version_schema');
        $createTable->addColumn(
            new Varchar(
                'version', 255, true, null,
                [
                    'comment' => 'The schema version for Kojo.',
                ]));

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}