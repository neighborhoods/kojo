<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown\Schema;

use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\DropTable;

class Version_0_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable('kojo_jobs_version_schema');
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}