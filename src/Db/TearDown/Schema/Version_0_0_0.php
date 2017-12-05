<?php

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Db\Schema\AbstractVersion;
use NHDS\Jobs\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\DropTable;

class Version_0_0_0 extends AbstractVersion
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable('nhds_jobs_version_schema');
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}