<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema;

interface VersionInterface
{
    public function applySchemaChanges(): VersionInterface;

    public function assembleSchemaChanges(): VersionInterface;
}