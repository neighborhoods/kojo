<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown\Schema;

use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;

class Version_0_0_0 extends VersionAbstract
{
    protected function _assembleSchemaChanges(): VersionInterface
    {
        $this->setTableName('kojo_jobs_version_schema');

        return $this;
    }
}