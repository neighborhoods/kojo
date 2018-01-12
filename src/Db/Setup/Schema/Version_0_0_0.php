<?php

namespace NHDS\Jobs\Db\Setup\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\CreateTable;

class Version_0_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable('nhds_jobs_version_schema');
        $createTable->addColumn(
            new Varchar(
                'version', 255, true, null,
                [
                    'comment' => 'The schema version for jobs.',
                ]));

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}