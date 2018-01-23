<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\TearDown\Schema;

use NHDS\Jobs\Data\Job\Type\PerpetualInterface;
use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\DropTable;

class Version_6_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable(PerpetualInterface::TABLE_NAME);
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}