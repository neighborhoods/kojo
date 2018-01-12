<?php

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\DropTable;

class Version_0_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable('nhds_jobs_version_schema');
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}