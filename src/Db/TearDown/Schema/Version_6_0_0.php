<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown\Schema;

use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\StateTransitionChange;

class Version_6_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $this->setTableName(StateTransitionChange\RepositoryInterface::TABLE_NAME);

        return $this;
    }
}
