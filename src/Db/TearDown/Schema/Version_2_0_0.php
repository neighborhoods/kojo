<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown\Schema;

use Neighborhoods\Kojo\Data\StatusInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;

class Version_2_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $this->setTableName(StatusInterface::TABLE_NAME);

        return $this;
    }
}
