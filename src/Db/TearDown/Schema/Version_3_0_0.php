<?php

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Db\Schema\AbstractVersion;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Status\Message;
use Zend\Db\Sql\Ddl\DropTable;

class Version_3_0_0 extends AbstractVersion
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable(Message::TABLE_NAME);
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}