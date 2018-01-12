<?php

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Status\Message;
use Zend\Db\Sql\Ddl\DropTable;

class Version_3_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable(Message::TABLE_NAME);
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}