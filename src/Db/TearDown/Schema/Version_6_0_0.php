<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown\Schema;

use Neighborhoods\Kojo\Data\AutoSchedule\SqsInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\DropTable;

class Version_6_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $dropTable = new DropTable(SqsInterface::TABLE_NAME);
        $this->_setSchemaChanges($dropTable);

        return $this;
    }
}