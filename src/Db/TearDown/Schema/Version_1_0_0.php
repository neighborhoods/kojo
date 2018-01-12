<?php

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Status\Type;
use Zend\Db\Sql\Ddl\DropTable;

class Version_1_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable(Type::TABLE_NAME);
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}