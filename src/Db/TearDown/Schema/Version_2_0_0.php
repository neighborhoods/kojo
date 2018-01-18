<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Status;
use Zend\Db\Sql\Ddl\DropTable;

class Version_2_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable(Status::TABLE_NAME);
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}