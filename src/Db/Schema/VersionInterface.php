<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\Schema;

interface VersionInterface
{
    public function applySchemaChanges(): VersionInterface;

    public function assembleSchemaChanges(): VersionInterface;
}